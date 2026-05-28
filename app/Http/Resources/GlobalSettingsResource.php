<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GlobalSettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'site_name' => $this->site_name,
            'donation_cta_text' => $this->donation_cta_text,
            'show_floating_button' => $this->show_floating_button,
            'floating_button_pages' => $this->floating_button_pages,
            'footer_copyright' => $this->footer_copyright,
            'footer_intro' => $this->footer_intro,
            'page_visibility' => $this->page_visibility,
            'page_settings' => $this->page_settings,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
