<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/user', 'User::user', ['filter' => 'role:admin']);
$routes->get('/user/create', 'User::create', ['filter' => 'role:admin']);
$routes->get('/setelan', 'Setelan::index', ['filter' => 'role:admin']);
$routes->get('/permohonan', 'Permohonan::index');
$routes->get('/riwayat', 'Riwayat::index', ['filter' => 'role:user']);
$routes->get('/riwayat/download/(:segment)', 'Download::download/$1', ['filter' => 'role:user']);
$routes->get('/permohonan/form_(:num)', 'Permohonan::form$1');
$routes->post('/permohonan/cari', 'Permohonan::livesearch', ['filter' => 'role:admin']);
$routes->post('/permohonan/save/(:num)', 'Permohonan::tambah_form_$1');
$routes->post('/setelan/update/status', 'Setelan::update_status', ['filter' => 'role:admin']);
$routes->post('/setelan/update/perangkat/(:num)', 'Setelan::update_perangkat/$1', ['filter' => 'role:admin']);
$routes->post('/setelan/update/nomor/(:num)', 'Setelan::update_nomor/$1', ['filter' => 'role:admin']);
$routes->post('/user/save', 'User::save', ['filter' => 'role:admin']);
$routes->get('/user/detail/(:num)', 'User::detail/$1', ['filter' => 'role:admin']);
$routes->get('/user/edit/(:num)', 'User::edit/$1', ['filter' => 'role:admin']);
$routes->post('/user/update/(:num)', 'User::update/$1', ['filter' => 'role:admin']);
$routes->delete('/user/delete/(:num)', 'User::hapus/$1', ['filter' => 'role:admin']);
$routes->get('/permohonan-baru', 'Verifikasi::index', ['filter' => 'role:admin']);
$routes->get('/permohonan-disetujui', 'Verifikasi::permohonan_disetujui', ['filter' => 'role:admin']);
$routes->post('/permohonan-disetujui/upload', 'Verifikasi::upload_scan', ['filter' => 'role:admin']);
$routes->get('/permohonan-ditolak', 'Verifikasi::permohonan_ditolak', ['filter' => 'role:admin']);
$routes->get('/permohonan-baru/verifikasi/(:num)', 'Verifikasi::form_verifikasi/$1', ['filter' => 'role:admin']);
$routes->post('/verifikasi/setuju', 'Verifikasi::setuju', ['filter' => 'role:admin']);
$routes->post('/verifikasi/tolak', 'Verifikasi::tolak', ['filter' => 'role:admin']);
$routes->delete('/verifikasi/delete/(:num)', 'Verifikasi::hapus/$1', ['filter' => 'role:admin']);
$routes->get('/profil', 'Profil::index');
$routes->post('/profil/ubah-password', 'Profil::ubah_password');

// Pengarsipan
$routes->get('/arsip-surat', 'Arsip::index', ['filter' => 'role:admin']);
$routes->get('/arsip-surat/detail/(:num)', 'Arsip::detail/$1', ['filter' => 'role:admin']);
$routes->delete('/arsip-surat/delete/(:num)', 'Arsip::hapus/$1', ['filter' => 'role:admin']);
$routes->post('/arsip-surat/upload-baru', 'Arsip::upload_scan_baru', ['filter' => 'role:admin']);

// Print Surat
$routes->get('/verifikasi/cetak-surat-1/(:num)', 'Cetak::print_1/$1', ['filter' => 'role:admin']);
$routes->get('/verifikasi/cetak-surat-2/(:num)', 'Cetak::print_2/$1', ['filter' => 'role:admin']);
$routes->get('/verifikasi/cetak-surat-3/(:num)', 'Cetak::print_3/$1', ['filter' => 'role:admin']);
$routes->get('/verifikasi/cetak-surat-4/(:num)', 'Cetak::print_4/$1', ['filter' => 'role:admin']);
$routes->get('/verifikasi/cetak-surat-5/(:num)', 'Cetak::print_5/$1', ['filter' => 'role:admin']);
$routes->get('/verifikasi/cetak-surat-6/(:num)', 'Cetak::print_6/$1', ['filter' => 'role:admin']);
$routes->get('/verifikasi/cetak-surat-7/(:num)', 'Cetak::print_7/$1', ['filter' => 'role:admin']);
$routes->get('/verifikasi/cetak-surat-8/(:num)', 'Cetak::print_8/$1', ['filter' => 'role:admin']);
$routes->get('/verifikasi/cetak-surat-9/(:num)', 'Cetak::print_9/$1', ['filter' => 'role:admin']);


// Akses gambar
$routes->get('/images/(:any)', 'Gambar::getImage/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
