<?php
namespace App\Entity;


enum Statut:string {
    Case R = "Reçu";
    Case EC = "En cours";
    Case T = "Terminer";
}