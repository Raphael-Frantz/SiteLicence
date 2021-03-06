<?php
// @need etudiants la liste des étudiants
// @need diplome le diplôme sélectionné (ou -1 si aucun)
// @need mode le mode : 1 => liste des étudiants inscrits dans un diplôme/semestre
//                      2 => liste des étudiants non inscrits dans le diplôme

if(count($data['etudiants']) == 0) {
    if($data['diplome'] == -1)
        $msg = "Il n'y a aucun étudiant sur le site.";
    else {
        if($data['mode'] == 1)
            if($data['semestre'] == -1)
                $msg = "Il n'y a aucun étudiant inscrit dans ce diplôme.";
            else
                $msg = "Il n'y a aucun étudiant inscrit dans ce semestre.";
        else
            $msg = "Il n'y a aucun étudiant non inscrit dans ce diplôme et ce semestre.";
    }
    echo <<<HTML
<div class="media alert-danger text-center" id="message">
  <div class="media-body">
    <p class="lead mb-0" id="contenuMessage">{$msg}</p>
  </div>
</div>
HTML;
}
else {
    echo <<<HTML
<table class="table table-striped" id="tableEtudiants">
  <thead>
    <tr>
      <th scope="col">Numéro</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Email</th>
      <th class="text-right" scope="col">Actions</th>
    </tr>
  </thead>
HTML;
    $lienModif = WEB_PATH."etudiants/modifier.php";
    $lienSupp = WEB_PATH."etudiants/supprimer.php";
    $lienRole = WEB_PATH."users/role.php";
    foreach($data['etudiants'] as $etudiant) {
        echo <<<HTML
        <tr id='ligne{$etudiant['id']}'>
          <th scope='row'>{$etudiant['numero']}</th>
          <td>{$etudiant['nom']}</td>
          <td>{$etudiant['prenom']}</td>
          <td>{$etudiant['email']}</td>
          <td class="text-right">
HTML;
        if($data['mode'] == 1) {
            echo <<<HTML
            <button name='idModi' type='submit' class='btn btn-sm btn-outline-primary mr-2' data-toggle='tooltip' 
                    data-placement='top' title="Modifier l'étudiant" form='controlForm' formaction='$lienModif' 
                    value='{$etudiant['id']}'>
              <i class='icon-wrench'></i>
            </button>
HTML;
            if(UserModel::estAdmin()) {
                echo <<<HTML
            <button name='idRole' type='submit' class='btn btn-sm btn-outline-primary mr-2' data-toggle='tooltip' 
                    data-placement='top' title="Prendre son rôle" form='controlForm' formaction='$lienRole' 
                    value='{$etudiant['id']}'>
              <i class='icon-user'></i>
            </button>
HTML;
            }
        }
        if($data['diplome'] == -1) {
            echo <<<HTML
            <button name='idSupp' type='submit' class='btn btn-sm btn-outline-danger mr-2' data-toggle='tooltip' 
                    data-placement='top' title="Supprimer l'étudiant" form='controlForm' formaction='$lienSupp' 
                    value='{$etudiant['id']}'>
              <i class='icon-trash'></i>
            </button>            
HTML;
        }
        else {
            if($data['mode'] == 2)
                echo <<<HTML
            <a class='btn btn-sm btn-outline-warning mr-2' href='javascript:inscription({$etudiant['id']})' data-toggle="tooltip" data-placement="top" title="Inscrire l'étudiant">
              <i class="icon-plus"></i>
            </a>
HTML;
            if(($data['mode'] == 1) && ($data['diplome'] != -1) && ($data['semestre'] != -1))
                echo <<<HTML
            <a class='btn btn-sm btn-outline-danger mr-2' href='javascript:desinscription({$etudiant['id']})' data-toggle="tooltip" data-placement="top" title="Désinscrire l'étudiant">
              <i class="icon-minus"></i>
            </a>
HTML;
        }
        echo <<<HTML
          </td>
        </tr>
HTML;
    }
    echo "</table>";
}