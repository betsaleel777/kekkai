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

// Acceuil > enseignants_alter
Breadcrumbs::for('enseignant_alter', function ($trail, $enseignant) {
    $trail->parent('enseignants') ;
    $trail->push($enseignant->nomination, route('enseignant_alter',$enseignant)) ;
});




?>
