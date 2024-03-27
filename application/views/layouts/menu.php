<?php
if (isSuperadmin()) {
    $this->load->view('layouts/menu-superadmin');
}

else if (isAdmin()) {
    $this->load->view('layouts/menu-admin');
}

else if (isKasir()) {
    $this->load->view('layouts/menu-kasir');
}

?>