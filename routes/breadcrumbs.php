<?php
// Acceuil
Breadcrumbs::for('acceuil', function ($trail) {
    $trail->push('Acceuil', route('start'));
});

// Acceuil > enseignants
Breadcrumbs::for('enseignants', function ($trail) {
    $trail->parent('acceuil') ;
    $trail->push('Enseignants', route('enseignant_index')) ;
});

// Acceuil > enseignants_trashed
Breadcrumbs::for('enseignant_trashed', function ($trail) {
    $trail->parent('enseignants') ;
    $trail->push('Enseignants Archivés', route('enseignant_trashed')) ;
});

// Acceuil > enseignants_add
Breadcrumbs::for('enseignant_add', function ($trail) {
    $trail->parent('enseignants') ;
    $trail->push('Ajouter', route('enseignant_add')) ;
});

// Acceuil > enseignant_show
Breadcrumbs::for('enseignant_show', function ($trail, $enseignant) {
    $trail->parent('enseignants') ;
    $trail->push($enseignant->nomination, route('enseignant_show',$enseignant)) ;
});

// Acceuil > enseignant_alter
Breadcrumbs::for('enseignant_alter', function ($trail, $enseignant) {
    $trail->parent('enseignants') ;
    $trail->push($enseignant->nomination, route('enseignant_alter',$enseignant)) ;
});
//-------------------------------------------------------------------------------------------

// Acceuil > ues
Breadcrumbs::for('ues', function ($trail) {
    $trail->parent('acceuil') ;
    $trail->push('Unités d\'enseignement', route('ues_index')) ;
});

// Acceuil > ues_trashed
Breadcrumbs::for('ues_trashed', function ($trail) {
    $trail->parent('ues') ;
    $trail->push('Unités d\'enseignement Archivés', route('ues_trashed')) ;
});

// Acceuil > ues_add
Breadcrumbs::for('ues_add', function ($trail) {
    $trail->parent('ues') ;
    $trail->push('Ajouter UE', route('ues_add')) ;
});

// Acceuil > enseignant_show
Breadcrumbs::for('ues_show', function ($trail, $ue) {
    $trail->parent('ues') ;
    $trail->push($ue->libelle, route('ues_show',$ue)) ;
});

// Acceuil > enseignant_alter
Breadcrumbs::for('ues_alter', function ($trail, $ue) {
    $trail->parent('ues') ;
    $trail->push($ue->libelle, route('ues_alter',$ue)) ;
});

//Acceuil > assignation
Breadcrumbs::for('assignations', function ($trail) {
    $trail->parent('acceuil') ;
    $trail->push('Assignations', route('assignations_index')) ;
});
//Acceuil > assignations_add
Breadcrumbs::for('assignations_add', function ($trail) {
    $trail->parent('assignations') ;
    $trail->push('Assigner des Heures Multiple', route('assignations_add')) ;
});
//Acceuil > assignations_simple_add
Breadcrumbs::for('assignations_simple_add', function ($trail) {
    $trail->parent('assignations') ;
    $trail->push('Assigner Simplement', route('assignations_simple_add')) ;
});
//Acceuil > assignation_alter
Breadcrumbs::for('assignations_alter', function ($trail,$assignation) {
    $trail->parent('assignations') ;
    $trail->push('Modifications des Heures', route('assignations_alter',$assignation)) ;
});



?>
