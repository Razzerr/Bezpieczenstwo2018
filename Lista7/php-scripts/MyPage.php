<?php
    class myPage{
        private $Title = "";
        private $Author = "GoldValley";
        private $Desc = "";
        private $projectPath = "";

        function __construct(){
            $this->projectPath = realpath(__DIR__."/..");
        }

        public function SetDescription($arg = "") {
            $this->Desc = $arg;
        }
        public function SetTitle($arg = "") {
            $this->Title = $arg;
        }
        public function SetAuthor($arg = "") {
            $this->Author = $arg;
        }

        public function Begin(){
            $lines = file_get_contents($this->projectPath."\HTMLElements\begin.txt");
            $lines = str_replace("%desc%", $this->Desc, $lines);
            $lines = str_replace("%title%", $this->Title, $lines);
            $lines = str_replace("%author%", $this->Author, $lines);
            return $lines;
        } 

        public function Header(){
            $lines = file_get_contents($this->projectPath."\HTMLElements\header.txt");
            return $lines;
        }

        public function mainMenu(){
            $lines = file_get_contents($this->projectPath."\HTMLElements\mainMenu.txt");
            return $lines;
        }

        public function loginMenu(){
            $lines = file_get_contents($this->projectPath."\HTMLElements\loginMenu.txt");
            return $lines;
        }

        public function loginModule(){
            $lines = file_get_contents($this->projectPath."\HTMLElements\login.txt");
            return $lines;
        }

        public function passwordReset(){
            $lines = file_get_contents($this->projectPath."\HTMLElements\passwordReset.txt");
            return $lines;
        }

        public function passwordChange($email, $login){
            $lines = file_get_contents($this->projectPath."\HTMLElements\passwordChange.txt");
            $lines = str_replace("%email%", $email, $lines);
            $lines = str_replace("%login%", $login, $lines);
            return $lines;
        }

        public function transactionForm($balance, $transactions){
            $lines = file_get_contents($this->projectPath."\HTMLElements/transactionForm.txt");
            $lines = str_replace("%balance%", $balance, $lines);
            $lines = str_replace("%transactions%", $transactions, $lines);
            return $lines;
        }

        public function transactionConf($receiver, $amount){
            $lines = file_get_contents($this->projectPath."\HTMLElements/transactionConf.txt");
            $lines = str_replace("%receiver%", $receiver, $lines);
            $lines = str_replace("%amount%", $amount, $lines);
            return $lines;
        }

        public function finilize(){
            $lines = file_get_contents($this->projectPath."\HTMLElements/finilize.txt");
            return $lines;
        }

        public function registerModule(){
            $lines = file_get_contents($this->projectPath."\HTMLElements/register.txt");
            return $lines;
        }

        public function createDiv2_6($head = "", $body = ""){
            $lines = file_get_contents($this->projectPath."\HTMLElements\div2_6.txt");
            $lines = str_replace("%head%", $head, $lines);
            $lines = str_replace("%body%", $body, $lines);
            return $lines;
        }

        public function createDiv3_6($head = "", $body = ""){
            $lines = file_get_contents($this->projectPath."\HTMLElements\div3_6.txt");
            $lines = str_replace("%head%", $head, $lines);
            $lines = str_replace("%body%", $body, $lines);
            return $lines;
        }

        public function createDiv4_6($head = "", $body = ""){
            $lines = file_get_contents($this->projectPath."\HTMLElements\div4_6.txt");
            $lines = str_replace("%head%", $head, $lines);
            $lines = str_replace("%body%", $body, $lines);
            return $lines;
        }

        public function createDiv6_6($head = "", $body = ""){
            $lines = file_get_contents($this->projectPath."\HTMLElements\div6_6.txt");
            $lines = str_replace("%head%", $head, $lines);
            $lines = str_replace("%body%", $body, $lines);
            return $lines;
    }

    public function Footer(){
        $lines = file_get_contents($this->projectPath."/HTMLElements/footer.txt");
        return $lines;
    }

    public function End(){
        $lines = file_get_contents($this->projectPath."/HTMLElements/end.txt");
        return $lines;
    }
}
?>
