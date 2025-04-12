@extends('layouts.app')  

@section('content')  
<div class="container mt-4">  
    <h2 class="text-center"><i class="fas fa-coins"></i> Sales</h2>
    <h3 class="text-center">Welocome Back {{ Auth::user()->name }}</h3>  
   
    <!-- Include the Livewire Sales Form Component -->  
    <livewire:sales-form />  
  
</div>  

<style>  
    /* Custom Styles */  
    body {  
        background-color: #f8f9fa; /* Light background */  
    }  

    .container {  
        max-width: 600px; /* Max width for the form */  
    }  

    .alert {  
        margin-top: 15px; /* Add spacing for alerts */  
    }  

    /* Styles for print view */  
    @media print {  
        body {  
            visibility: hidden; /* Hide everything else */  
        }  
        #receipt, #receipt * {  
            visibility: visible; /* Show only the receipt */  
        }  
        #receipt {  
            position: absolute;  
            left: 0;  
            top: 0;  
            margin: 0;  
            padding: 0;  
        }  
    }  
</style>  

<script>  
    document.addEventListener('livewire:load', function () {  
        // Show the receipt when the buy action is successful  
        Livewire.on('receiptShown', () => {  
            const receipt = document.getElementById('receipt');  
            receipt.style.display = 'block'; // Show receipt  
            const printButton = document.getElementById('print-receipt');  
            printButton.style.display = 'inline-block'; // Show print button  
        });  
    });  

    function printReceipt() {  
        const receipt = document.getElementById('receipt');  
        const printWindow = window.open('', '', 'height=600,width=800');  
        printWindow.document.write('<html><head><title>Receipt</title>');  
        printWindow.document.write('</head><body>');  
        printWindow.document.write(receipt.innerHTML); // Write receipt content to print window  
        printWindow.document.write('</body></html>');  
        printWindow.document.close();  
        printWindow.print(); // Trigger the print dialog  
    }  
</script>  
@endsection  