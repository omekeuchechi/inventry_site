<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Cloudinary\Cloudinary;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class AdminSettings extends Component
{
    use WithFileUploads;

    public $company_name;
    public $favicon;
    public $keywords;
    public $web_color;
    public $logo;

    public $setbg;


    public function render()
    {
        $settings = Settings::where('id', 1)->first();
        return view('livewire.admin-settings', [
            'settings' => $settings,
        ]);
    }
    public function updateCompanyName()
    {
        // Logic to update settings
        // 'company_name',
        // 'favicon',
        // 'keywords',
        // 'web_color',
        // 'logo',

        $this->validate([  
            'company_name' => 'required|string|max:255',  
        ]);

        $settings = Settings::where('id', 1)->first();

        $settings->company_name = $this->company_name;
        $settings->updateded_by = Auth::user()->id;
        $settings->save();

        session()->flash('message', 'Settings updated successfully.');
    }
    public function updateFavicon()
    {
        // Fetch settings record
        $settings = Settings::where('id', 1)->first();
    
        // Validate the request
        $this->validate([
            'favicon' => 'required|image|mimes:ico,png,jpg,jpeg,svg,webp|max:8048',
        ]);
    
        $cloudinary = new Cloudinary();
    
        // Delete previous favicon from Cloudinary if it exists this will work perfectly well i think so try it out new pattern of minimizing cloud storage
        if ($settings->favicon) {
            $publicId = pathinfo(parse_url($settings->favicon, PHP_URL_PATH), PATHINFO_FILENAME);
            $cloudinary->uploadApi()->destroy("favicon/{$publicId}"); // assuming favicon was saved in 'favicon' folder
        }
    
        // Upload new favicon
        $uploadedFile = $cloudinary->uploadApi()->upload(
            $this->favicon->getRealPath(),
            ['folder' => 'favicon']
        );
    
        // Save new favicon URL
        $settings->favicon = $uploadedFile['secure_url'];
        $settings->updateded_by = Auth::user()->id;
        $settings->save();
    
        session()->flash('message', 'Favicon was updated successfully.');
    }
    
    
    public function updateKeywords()
    {
        $settings = Settings::where('id', 1)->first();

        $this->validate([  
            'keywords' => 'required|string|max:255',  
        ]);
        $settings->keywords = $this->keywords;
        $settings->updateded_by = Auth::user()->id;
        $settings->save();
        session()->flash('message', 'Settings updated successfully.');
    }
    public function updateWebColor()
    {
        $settings = Settings::where('id', 1)->first();
        $this->validate([  
            'web_color' => 'required|string|max:255',  
        ]);
        $settings->web_color = $this->web_color;
        $settings->updateded_by = Auth::user()->id;
        $settings->save();
        session()->flash('message', 'Settings updated successfully.');
    }
    public function updateLogo()
    {
        // Fetch settings record
        $settings = Settings::where('id', 1)->first();
        // Validate the request
        $this->validate([
            'logo' => 'required|image|mimes:ico,png,jpg,jpeg,svg,webp|max:8048',
        ]);
        
        $cloudinary = new Cloudinary();

        // Delete previous logo from Cloudinary if it exists this will work perfectly well i think so try it out new pattern of minimizing cloud storage
        if ($settings->logo) {
            $publicId = pathinfo(parse_url($settings->logo, PHP_URL_PATH), PATHINFO_FILENAME);
            $cloudinary->uploadApi()->destroy("logo/{$publicId}");
        }
        // Upload new logo
        $uploadedFile = $cloudinary->uploadApi()->upload(
            $this->logo->getRealPath(),
            ['folder' => 'logo']
        );
        // Save new logo URL to the database table called Settings take note
        $settings->logo = $uploadedFile['secure_url'];
        $settings->updateded_by = Auth::user()->id;
        $settings->save();
        session()->flash('message', 'Logo was updated successfully.');
    }

    public function updateSetBg()
    {
        $settings = Settings::where('id', 1)->first();
        $this->validate([  
            'setbg' => 'required|string|max:255',  
        ]);
        $settings->setbg = $this->setbg;
        $settings->updateded_by = Auth::user()->id;
        $settings->save();
        session()->flash('message', 'Settings updated successfully.');
    }

}
