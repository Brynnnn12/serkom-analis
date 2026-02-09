<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Base Controller untuk semua controller aplikasi
 *
 * Menyediakan method-method umum yang bisa digunakan oleh semua controller
 * untuk mengurangi duplikasi kode dan mempromosikan DRY principle.
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Helper method untuk response redirect dengan success message
     *
     * @param string $route Nama route tujuan
     * @param string $message Pesan sukses
     * @param array $params Parameter tambahan untuk route
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function successRedirect($route, $message, $params = [])
    {
        return redirect()->route($route, $params)->with('success', $message);
    }

    /**
     * Helper method untuk response redirect dengan error message
     *
     * @param string $route Nama route tujuan
     * @param string $message Pesan error
     * @param array $params Parameter tambahan untuk route
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function errorRedirect($route, $message, $params = [])
    {
        return redirect()->route($route, $params)->with('error', $message);
    }

    /**
     * Helper method untuk back dengan input dan error
     *
     * @param array $errors Array error messages
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function backWithErrors(array $errors)
    {
        return back()->withInput()->withErrors($errors);
    }

    /**
     * Helper method untuk cek guard admin
     *
     * @return bool True jika user adalah admin
     */
    protected function isAdmin()
    {
        return auth()->guard('web')->check();
    }

    /**
     * Helper method untuk cek guard pelanggan
     *
     * @return bool True jika user adalah pelanggan
     */
    protected function isPelanggan()
    {
        return auth()->guard('pelanggan')->check();
    }

    /**
     * Helper method untuk dapatkan current admin ID
     *
     * @return int|null Admin ID atau null jika bukan admin
     */
    protected function getCurrentAdminId()
    {
        return $this->isAdmin() ? auth()->guard('web')->id() : null;
    }

    /**
     * Helper method untuk dapatkan current pelanggan ID
     *
     * @return int|null Pelanggan ID atau null jika bukan pelanggan
     */
    protected function getCurrentPelangganId()
    {
        return $this->isPelanggan() ? auth()->guard('pelanggan')->id() : null;
    }
}
