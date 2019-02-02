<?php
    function convertKamar($x) {
        switch($x) {
            case "kasur":
                return "KASUR";
                break;
            case "lemari":
                return "LEMARI";
                break;
            case "meja":
                return "MEJA BELAJAR";
                break;
            case "rias":
                return "MEJA RIAS";
                break;
            case "kursi":
                return "KURSI";
                break;
            case "wifi":
                return "WI-FI";
                break;
        }
    }
    function convertMandi($x) {
        switch($x) {
            case "dalam":
                return "DALAM";
                break;
            case "shower":
                return "SHOWER";
                break;
            case "duduk":
                return "TOILET DUDUK";
                break;
            case "hangat":
                return "AIR HANGAT";
                break;
        }
    }
?>