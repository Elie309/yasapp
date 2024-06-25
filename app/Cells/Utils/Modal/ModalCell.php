<?php

namespace App\Cells\Utils\Modal;

use CodeIgniter\View\Cells\Cell;

class ModalCell extends Cell
{
    public $modalId;
    public $modalTitle;
    public $modalBody;
    public $confirmButtonText = 'Confirm';
    public $confirmButtonClass = 'bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700';
    public $cancelButtonText = 'Cancel';
    public $cancelButtonClass = 'bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600';
    

  
}
