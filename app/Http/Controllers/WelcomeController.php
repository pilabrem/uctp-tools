<?php

namespace App\Http\Controllers;


class WelcomeController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
        // return view('welcome');
    }

    public function test()
    {
        // Pour un petit problème
        $minCours = 2;
        $maxCours = 100;
        $minEtudiants = 10;
        $maxEtudiants = 80;

        $nbEtudiants = random_int($minEtudiants, $maxEtudiants);
        $nbCours = random_int($minCours, $maxCours);

        // Pour chaque étudiant, générer son nombre de cours
        $listEtudiants = array();
        for ($i = 0; $i < $nbEtudiants; $i++) {
            $nbCoursEtudiant = random_int(1, $nbCours);
            $etudiant = [
                'id' => $i + 1,
                'nbCours' => $nbCoursEtudiant,
            ];
            $listCoursEtudiant = array();
            for ($j = 0; $j < $nbCoursEtudiant; $j++) {
                // choisir un numéros de cours aléatoirement pour l'étudiant
                //...
            }
            $etudiant['cours'] = $listCoursEtudiant;
            $listEtudiants[] = $etudiant;
        }

        // ..
    }
}
