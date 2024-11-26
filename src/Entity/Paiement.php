<?php
namespace App\Entity;


enum Paiement:string {
    Case ESPECE = "Espèce";
    Case CHEQUE = "Chèque";
    Case CB = "Carte Bancaire";
}