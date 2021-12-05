<?php
    class Validation
    {
        public function strongPassword($password)
        {
            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6) {
                echo 'A senha deve ter pelo menos 6 caracteres de comprimento e deve incluir pelo menos uma letra maiúscula, um número e um caractere especial.';
                return false;
            }else{
                return true;
            }
            //Code by www.codexworld.com
        }
    }
    
?>