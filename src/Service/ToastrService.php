<?php


namespace App\Service;

use Flasher\Prime\Envelope;
use Flasher\Toastr\Prime\ToastrFactory;

class ToastrService
{
    private $toastr;

    /**
     * @param ToastrFactory $toastr
     */
    public function __construct( ToastrFactory $toastr)
    {
        $this->toastr = $toastr;
    }

    public function toastrError($message): Envelope
    {
        return $this->toastr->addError($message, [
            "closeButton" => true,
            "debug" => false,
            "newestOnTop" => false,
            "progressBar" => true,
            "positionClass" => "toast-top-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "14000",
            "extendedTimeOut" => "14000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut",
            "espaceHTML" => true,
        ]);
    }

    public function toastrSuccess($message): Envelope
    {
        return $this->toastr->addSuccess($message, [
            "closeButton" => true,
            "debug" => false,
            "newestOnTop" => false,
            "progressBar" => true,
            "positionClass" => "toast-top-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "14000",
            "extendedTimeOut" => "14000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut",
            "espaceHTML" => true,
        ]);
    }

    public function toastrWarning($message): Envelope
    {
        return $this->toastr->addWarning($message, [
            "closeButton" => true,
            "debug" => false,
            "newestOnTop" => false,
            "progressBar" => true,
            "positionClass" => "toast-top-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "14000",
            "extendedTimeOut" => "14000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut",
            "espaceHTML" => true,
        ]);
    }

    public function toastrInfo($message): Envelope
    {
        return $this->toastr->addInfo($message, [
            "closeButton" => true,
            "debug" => false,
            "newestOnTop" => false,
            "progressBar" => true,
            "positionClass" => "toast-top-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "14000",
            "extendedTimeOut" => "14000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut",
            "espaceHTML" => true,
        ]);
    }

    public function toastrError404($code): Envelope
    {
//        return $this->toastr->addError("Une erreur inconnue est arrivé. Veuillez contacter le support. (Code erreur : " . $code . ")" . "<br><button type='button' class='btn btn-primary clear close'>Yes</button>", [
        return $this->toastr->addError("Une erreur inconnue est arrivé. Veuillez-contacter le support. (Code erreur : " . $code . ")", [
            "closeButton" => true,
            "debug" => false,
            "newestOnTop" => false,
            'closeHtml' => '<button><i class="fa fa-close text-white fa-lg"></i></button>',
            "progressBar" => false,
            "positionClass" => "toast-top-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "0",
            "extendedTimeOut" => "0",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut",
            "tapToDismiss" => false
        ]);
    }
}