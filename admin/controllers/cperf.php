<?php
require_once('admin/models/mperf.php');
$mper = new Mperf();

$idper = isset($_REQUEST['idper']) ? $_REQUEST['idper'] : NULL;
$nomper = isset($_POST['nomper']) ? $_POST['nomper'] : NULL;
$idpag = isset($_POST['idpag']) ? $_POST['idpag'] : NULL;
$mdl = isset($_POST['mdl']) ? $_POST['mdl'] : NULL;
$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera'] : NULL;
$datOne = NULL;

// Obtener datos de páginas
$dtm = $mper->getPag(); 

$mper->setIdper($idper);
if ($opera == "savepxp") {
    if ($idper) $mper->delPxP();
    if ($mdl) {
        foreach ($mdl as $md) {
            $mper->setIdpag($md);
            $mper->savePxP();
        }
    }
    echo "<script>window.location='home.php?pg=4021';</script>";
}

if ($opera == "save") {
    $mper->setNomper($nomper);
    $mper->setIdpag($idpag);
    if (!$idper) $mper->save();
    else $mper->edit();
}

if ($opera == "edi" && $idper) $datOne = $mper->getOne();

$dat = $mper->getAll();
$datpag = $mper->getPag();

function modal($id, $nm, $mt, $pg, $smd) {
    $html = '';
    $html .= '<div class="modal" id="myModal' . $id . '" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">';
        $html .= '<div class="modal-dialog">';
            $html .= '<div class="modal-content">';
                $html .= '<div class="modal-header">';
                    $html .= '<h3 class="modal-title">Páginas - ' . $nm . '</h3>';
                    $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                $html .= '</div>';
                $html .= '<form action="home.php?pg=' . $pg . '" method="POST">';
                    $html .= '<div class="modal-body">';
                        $html .= '<input type="hidden" value="' . $id . '" name="idper">';
                        $html .= '<div class="row">';
                        if ($mt) {
                            // Convierte $smd en un array para validar
                            $selectedPages = explode(',', $smd);

                            foreach ($mt as $dtm) {
                                $html .= '<div class="dpag form-group col-md-6" style="margin-bottom: 0px; text-align:left !important;">';
                                    $html .= '<i class="fa ' . $dtm['icopag'] . '" style="color: #117f09;"></i>';
                                    $html .= '<input type="checkbox" name="mdl[]" value="' . $dtm['idpag'] . '"';
                                    if (in_array($dtm['idpag'], $selectedPages)) {
                                        $html .= ' checked';
                                    }
                                    $html .= '> ';
                                    $html .= $dtm['titupag'] . " ";
                                $html .= '</div>';
                            }
                        }
                        $html .= '</div>';
                    $html .= '</div>';
                    $html .= '<div class="modal-footer">';
                        $html .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                        $html .= '<input type="hidden" value="savepxp" name="opera">';
                        $html .= '<input type="submit" class="btn btn-primary" value="Guardar">';
                    $html .= '</div>';
                $html .= '</form>';
            $html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';
    echo $html;
}



?>
