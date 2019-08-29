<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/upload/profil/thumb/'.$this->session->userdata('avatar')) ?>" class="img-rounded" alt="User Image" />
            </div>
            <div class="pull-left info">
                <small><?php echo $this->session->userdata('fullname')?><br>
                    <?php if($this->ion_auth->is_admin()){ echo 'Administrator'; } else { echo 'Member';} ?></small><br>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Menu Utama</li>
                        <?php
                        // data main menu
                        $main_menu = $this->db->get_where('tabel_menu', array('is_main_menu' => 0));
                        foreach ($main_menu->result() as $main) {
                            // Query untuk mencari data sub menu
                            $sub_menu = $this->db->get_where('tabel_menu', array('is_main_menu' => $main->id));
                            // periksa apakah ada sub menu
                            if ($sub_menu->num_rows() > 0) {
                                // main menu dengan sub menu
                                echo "<li class='treeview'>" . anchor($main->link, '<i class="' . $main->icon . '"></i>' . $main->judul_menu .
                                        '<span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>');
                                // sub menu nya disini
                                echo "<ul class='treeview-menu'>";
                                foreach ($sub_menu->result() as $sub) {
                                    echo "<li>" . anchor($sub->link, '<i class="' . $sub->icon . '"></i>' . $sub->judul_menu) . "</li>";
                                }
                                echo"</ul></li>";
                            } else {
                                // main menu tanpa sub menu
                                echo "<li>" . anchor($main->link, '<i class="' . $main->icon . '"></i>' . $main->judul_menu) . "</li>";
                            }
                        }
                        ?>
            <li class="header">Lain-lain</li>
            <li><a href="!#" data-toggle="modal" data-target="#tentang"><i class="fa fa-book"></i> Tentang SIAP</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
    <div id="tentang" class="modal fade" role="dialog">
       <div class="modal-dialog">
        <!-- konten modal-->
        <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tentang</h4>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <p>Aplikasi <b>SIAP</b> (Sistem Informasi dan Administrasi Pemeriksaan)
                <b>Versi 1.0</b>
                <br><br>
                <i class="fa fa-envelope" aria-hidden="true"></i> heryandwiyoga@gmail.com<br>
                <i class="fa fa-whatsapp" aria-hidden="true"></i> 082329247870
                </p>
            </div>
        </div>
    </div>
    </div>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
