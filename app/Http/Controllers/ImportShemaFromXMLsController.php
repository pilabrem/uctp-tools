<?php

namespace App\Http\Controllers;

use Exception;
use SimpleXMLElement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ImportShemaFromXML;
use App\Http\Controllers\Controller;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTable;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTableField;

// Pilabrem
class ImportShemaFromXMLsController extends Controller
{
    public function __construct()
    {
        if (env('APP_ENV') !== 'local') {
            dd("Only available in local Mode");
        }
    }

    /**
     * Display a listing of the import shema from x m ls.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('import_shema_from_x_m_ls.index');
    }

    /**
     * Show the form for creating a new import shema from x m l.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('import_shema_from_x_m_ls.create');
    }

    /**
     * Store a new import shema from x m l in the storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $data = $this->getData($request);
            // Get XML file content
            $fileUrl = public_path("storage\\" . $data["fichier"]);
            $xml = new SimpleXMLElement($fileUrl, null, true);

            //Parcourir les pages du diagramme
            $nbPages = count($xml->diagram);
            for ($i = 0; $i < $nbPages; $i++) {
                // Récupérer la page actuelle
                $diagram = $xml->diagram[$i];
                // Les elements du diagramme (Page)
                $elements = (array) $diagram->mxGraphModel->root;
                // Stokage des reférences du model parent
                $xmlParentId = null;
                $tableParentId = 0;
                // Parcourir les éléments
                $nbElements = count($elements["mxCell"]);
                for ($j = 0; $j < $nbElements; $j++) {
                    $el = $elements["mxCell"][$j];

                    // Is a table Model, save it
                    if ($this->diagramElIsTable($el)) {
                        $xmlParentId = $el["id"] . ""; // Transform to string
                        $modelName = $el["value"];
                        // Create The table Model
                        $table = GeneratorTable::create(["name" => $modelName]);
                        $tableParentId = $table->id;
                    } else if ($this->diagramElIsTableField($el)) {
                        $fieldName = $el["value"] . "";
                        $elParentId = $el["parent"] . ""; // Transform to string

                        // Has parent table
                        if ($elParentId == $xmlParentId) {
                            // Get Field infos
                            $fieldInfos = (array) $this->getFieldInfos($fieldName);
                            $fieldInfos["generator_table_id"] = $tableParentId;
                            // Save Table Field
                            if ($fieldInfos["name"] != "id") {  // Don't Save IDs
                                GeneratorTableField::create($fieldInfos);
                            }
                        }
                    }
                }
            }

            return redirect()->route('import_shema_from_xmls.import_shema_from_xml.index')
                ->with('success_message', 'Shema importé avec succès');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Une erreur inconnue a été trouvée!']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'fichier' => ['file'],
        ];
        if ($request->route()->getAction()['as'] == 'import_shema_from_x_m_ls.importshemafromxml.store' || $request->has('custom_delete_fichier')) {
            array_push($rules['fichier'], 'required');
        }
        $data = $request->validate($rules);
        if ($request->has('custom_delete_fichier')) {
            $data['fichier'] = '';
        }
        if ($request->hasFile('fichier')) {
            $data['fichier'] = $this->moveFile($request->file('fichier'));
        }


        return $data;
    }

    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }

        $path = config('laravel-code-generator.files_upload_path', 'uploads/imported');
        $saved = $file->store("public");

        return substr($saved, 7);
    }


    public function getFieldInfos($field)
    {
        $matches = array();
        $s = preg_match('#^\+ ?(\w+) ?\: ?([a-zA-Z]+) ?\(?#', $field, $matches);

        // Get Field Name
        $name = isset($matches[1]) ? $matches[1] : null;
        //
        $type = isset($matches[2]) ? $matches[2] : null;

        $s = preg_match('# ?\( ?([\w,;\- ]+) ?\)#', $field, $matches);
        $typeParams = isset($matches[1]) ? $matches[1] : null;


        $html_type = $this->getHtmlType($type);
        $data_type = $this->getDataType($type);

        $fieldInfos = array(
            "name" => $name,
            "labels" => $this->nameToLabel($name),
            "validation" => "",
            "html_type" => $html_type,
            "options" => $this->getOptions($html_type, $typeParams),
            "data_type" => $data_type,
            "data_type_params" => $this->getDataTypeParams($data_type, $typeParams),
            "date_format" => $this->getDateFormat($data_type, $typeParams),
            "placeholder" => " "
        );

        return $fieldInfos;
    }

    public function nameToLabel($name)
    {
        while (Str::contains($name, '_')) {
            $name = Str::replaceFirst('_', ' ', $name);
        }

        return Str::title($name);
    }

    // Get Options
    public function getOptions($htmlType, $typeParams)
    {
        if ($typeParams == null) {
            return null;
        }

        if (in_array($htmlType, array("radio", "checkbox", "select", "multipleSelect"))) {
            return str_replace(',', '|', $typeParams);
        }

        return null;
    }

    // Get Data Type Params
    public function getDataTypeParams($dataType, $typeParams)
    {
        if ($typeParams == null) {
            return null;
        }

        if (in_array($dataType, array('char', 'varchar', 'string'))) {
            return $typeParams;
        }

        return null;
    }

    // Get Date format
    public function getDateFormat($dataType, $typeParams)
    {
        if ($typeParams == null) {
            return null;
        }

        if (in_array($dataType, array('date', 'datetime', 'datetimetz'))) {
            return $typeParams;
        }

        return null;
    }

    // Get HTML Type
    public function getHtmlType($elType)
    {
        $typeLower = mb_strtolower($elType);
        $htmlTypes = array(
            'string' => "text",
            'int' => "number",
            'integer' => "number",
            'bigint' => "number",
            'biginteger' => "number",
            'number' => "number",
            'boolean' => "checkbox",
            'bool' => "checkbox",
            'double' => "text",
            'text' => "textarea",
            'texte' => "textarea",
            'file' => "file",
            'enum' => "select",
            'date' => "text",
            'datetime' => "text",
            'timestamp' => "text"
        );
        return isset($htmlTypes[$typeLower]) ? $htmlTypes[$typeLower] : $elType;
    }

    // Get Data Type
    public function getDataType($elType)
    {
        $typeLower = mb_strtolower($elType);
        $htmlTypes = array(
            'string' => "string",
            'int' => "int",
            'integer' => "integer",
            'bigint' => "bigint",
            'biginteger' => "biginteger",
            'decimal' => "decimal",
            'number' => "int",
            'bool' => "bool",
            'boolean' => "boolean",
            'double' => "double",
            'text' => "text",
            'texte' => "text",
            'file' => "string",
            'enum' => "enum",
            'date' => "date",
            'datetime' => "datetime",
            'timestamp' => "timestamp"
        );

        return isset($htmlTypes[$typeLower]) ? $htmlTypes[$typeLower] : $elType;
    }

    public function hasFivesProps($el)
    {
        if ($el["id"] != null && $el["value"] != null && $el["style"] != null && $el["parent"] != null && $el["vertex"] != null) {
            return true;
        }
        return false;
    }

    // L'element du diagramme est une table
    public function diagramElIsTable($el)
    {
        if ($this->hasFivesProps($el)) {
            $style = $el["style"];
            $type = substr($style, 0, strpos($style, ";"));
            if ($type === "swimlane") {
                return true;
            }
        }

        return false;
    }

    // L'element du diagramme est un champ
    public function diagramElIsTableField($el)
    {
        if ($this->hasFivesProps($el)) {
            $name = $el["value"] . "";
            // Ne pas prendre en compte les IDs
            if ($name == "id") {
                return false;
            }

            $style = $el["style"];
            $type = substr($style, 0, strpos($style, ";"));
            if ($type === "text") {
                return true;
            }
        }

        return false;
    }
}
