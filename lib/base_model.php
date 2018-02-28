<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
      
    }
    public function validate_tuplat() {
        if (resepti::haeNimella($this->nimi) != null) {
            $errors[] = "Nimellä on jo resepti";
        }
       return $errors; 
    }
    
    public function validate_valmistusaika() {
        $errors = array();
        if ($this->valmistusaika == '' || $this->valmistusaika == null) {
            $errors[] = 'Ilmoita valmistusaika numeroin!';
        }
        if (is_numeric($this->valmistusaika) ==false ) {
            $errors[] = 'Valmistusaika tulee ilmoittaa numeroin (esim: 30)';
        }
        return $errors;
    }

    public function errors() {
        $errors = array();

        foreach ($this->validators as $validator) {
            $validator_error = $this->{$validator}();
            $errors = array_merge($errors, $validator_error);
        }
        return $errors;
    }

}
