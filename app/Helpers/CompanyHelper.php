<?php

namespace App\Helpers;

use App\Models\CompanySetting;

class CompanyHelper
{
    /**
     * Get company settings
     * Return object dengan data perusahaan
     */
    public static function getSettings()
    {
        return CompanySetting::getSettings();
    }

    /**
     * Get company logo URL
     * Return URL logo atau default logo
     */
    public static function getLogo()
    {
        $settings = self::getSettings();
        
        if ($settings->logo && file_exists(public_path('storage/' . $settings->logo))) {
            return asset('storage/' . $settings->logo);
        }
        
        // Return default logo jika belum ada setting
        return asset('admin-assets/images/logo-dark.svg');
    }

    /**
     * Get company name
     */
    public static function getName()
    {
        $settings = self::getSettings();
        return $settings->nama_perusahaan ?? 'RC Cloth';
    }

    /**
     * Get WhatsApp message template with variables replaced
     * 
     * @param \App\Models\Order $order
     * @return string
     */
    public static function getWhatsAppMessage($order)
    {
        $settings = self::getSettings();
        
        // Template default jika belum diset
        $template = $settings->template_wa ?? 'Halo {nama_pemesan}, terima kasih telah memesan di {nama_perusahaan}. Berikut invoice order Anda: {link_invoice}';
        
        // Replace variables
        $message = str_replace(
            ['{nama_pemesan}', '{nama_perusahaan}', '{link_invoice}', '{telepon}'],
            [
                $order->nama_pemesan,
                self::getName(),
                url('/admin/orders/' . $order->id . '/invoice'),
                $order->telepon
            ],
            $template
        );
        
        return $message;
    }
}
