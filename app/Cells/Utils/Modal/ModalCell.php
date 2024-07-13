<?php

namespace App\Cells\Utils\Modal;

use CodeIgniter\View\Cells\Cell;

class ModalCell extends Cell
{
    public $modalId;
    public $modalTitle;
    public $modalBody;
    public $closeButtonText = 'Close';
    public $closeButtonClass = 'bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700';
    

  
}
