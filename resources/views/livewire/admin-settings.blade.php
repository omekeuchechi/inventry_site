<div class="settings-container">  
    {{-- Logo and Favicon Display --}}  
    <div class="branding">  
        <img src="{{ $settings->logo }}" alt="Logo" class="branding-logo" id="logo">  
        <img src="{{ $settings->favicon }}" alt="Favicon" class="branding-favicon" id="favicon">  
    </div>  

    @if (session()->has('message'))  
        <div class="alert alert-success">{{ session('message') }}</div>  
    @endif  

    <div class="setting-box">  
        <div class="hide-setting"><span>Set</span> <i class="fas fa-angle-down"></i></div> <!-- Replaced icon with text "Set" -->  
        <form wire:submit.prevent="updateCompanyName" style="display:none;"> <!-- Initially hidden -->  
            @csrf  
            <input type="text" wire:model="company_name" placeholder="Enter company name" class="form-control">  
            @error('company_name') <span class="error">⚠ {{ $message }}</span> @enderror  
            <button type="submit">Update</button>  
        </form>  
    </div>  

    <div class="setting-box">  
        <div class="hide-setting"><span>Set favicon</span> <i class="fas fa-angle-down"></i></div> <!-- Replaced icon with text "Set" -->  
        <form wire:submit.prevent="updateFavicon" style="display:none;">  
            <input type="file" wire:model="favicon">  
            @error('favicon') <span class="error">⚠ {{ $message }}</span> @enderror  
            <button type="submit">Update</button>  
        </form>  
    </div>  

    <div class="setting-box">  
        <div class="hide-setting"><span>Set logo</span> <i class="fas fa-angle-down"></i></div> <!-- Replaced icon with text "Set" -->  
        <form wire:submit.prevent="updateLogo" style="display:none;">  
            <input type="file" wire:model="logo">  
            @error('logo') <span class="error">⚠ {{ $message }}</span> @enderror  
            <button type="submit">Update</button>  
        </form>  
    </div>  

    <div class="setting-box">  
        <div class="hide-setting"><span>Set keywords</span> <i class="fas fa-angle-down"></i></div> <!-- Replaced icon with text "Set" -->  
        <form wire:submit.prevent="updateKeywords" style="display:none;">  
            @csrf  
            <input type="text" wire:model="keywords" placeholder="Enter keywords" class="form-control">  
            @error('keywords') <span class="error">⚠ {{ $message }}</span> @enderror  
            <button type="submit">Update</button>  
        </form>  
    </div>  

    <div class="setting-box">  
        <div class="hide-setting"><span>Set Web color</span> <i class="fas fa-angle-down"></i></div> <!-- Replaced icon with text "Set" -->  
        <form wire:submit.prevent="updateWebColor" style="display:none;">  
            @csrf  
            <input type="color" wire:model="web_color" class="form-control">  
            @error('web_color') <span class="error">⚠ {{ $message }}</span> @enderror  
            <button type="submit">Update</button>  
        </form>  
    </div>  

    <div class="setting-box">  
        <div class="hide-setting"><span>Set Theme Style</span> <i class="fas fa-angle-down"></i></div> <!-- Replaced icon with text "Set" -->  
        <form wire:submit.prevent="updateSetBg" style="display:none;">  
            @csrf  
            <select wire:model="setbg" class="form-control">  
                <option value="">Theme</option>  
                <option value="logo">Background image</option>  
                <option value="web_color">Color</option>  
            </select>  
            @error('setbg') <span class="error">⚠ {{ $message }}</span> @enderror  
            <button type="submit">Update</button>  
        </form>  
    </div>  
</div>  

<style>  
    .error {  
        color: red;  
        font-size: 0.9rem;  
    }  
    .setting-box {  
        width: 90%;
        margin: 10px;  
        padding: 10px;  
        border: 1px solid #ccc;  
        border-radius: 5px;  
    }  
    .setting-box > form{
        display: none;  
        width: 60%;
        margin: 0 auto;
    }
    .setting-box > form > input{
        width: 50%;
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
    }
    .branding {  
        display: flex;
        justify-content: center;  
        align-items: center;  
        margin: -20px 0 0 0;
        gap: 20px;
        /* margin-bottom: 20px;   */
    }
    .branding-logo, .branding-favicon {  
        max-width: 100px;  
        margin-right: 10px;  
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s cubic-bezier(0.075, 0.82, 0.165, 1);
    }
    .branding-favicon {  
        width: 50%;  
        height: auto;
    }
    .branding-logo {  
        width: 50%;  
        height: auto;
    }
    .hide-setting {  
        cursor: pointer;  
        display: flex;  
        align-items: center;
        border-bottom: 1px solid #2194ff;
        justify-content: space-between;
        font-weight: bold;
    }  
</style>  

<script>  
// Ensure the DOM is loaded before running the script  
document.addEventListener('DOMContentLoaded', function() {  
    document.querySelectorAll('.hide-setting').forEach(function (setting) {  
        setting.addEventListener('click', function () {  
            const form = this.nextElementSibling; // Get the form immediately following the clicked setting  
            // Toggle form visibility  
            if (form.style.display === 'block') {  
                form.style.display = 'none';  
            } else {  
                form.style.display = 'block';  
            }  
        });  
    });  
});  

const logoPreview = document.getElementById('logo');
const faviconPreview = document.getElementById('favicon');

logoPreview.addEventListener('mouseover', function() {
    logoPreview.style.transform = 'scale(1.1)';
    logoPreview.style.transition = 'transform 0.2s';
    logoPreview.style.cursor = 'pointer';
    //adding attribute title
    logoPreview.setAttribute('title', 'Logo Preview');
});

logoPreview.addEventListener('mouseout', function() {
    logoPreview.style.transform = 'scale(1)';
});

faviconPreview.addEventListener('mouseover', function() {
    faviconPreview.style.transform = 'scale(1.1)';
    faviconPreview.style.transition = 'transform 0.2s';
    faviconPreview.style.cursor = 'pointer';
    //adding attribute title
    faviconPreview.setAttribute('title', 'Favicon Preview');
});
faviconPreview.addEventListener('mouseout', function() {
    faviconPreview.style.transform = 'scale(1)';
});
</script>