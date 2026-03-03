class BankAccount {
    constructor()
    $number;
    $name;
    $balance;

    public function __construct($num, $name, $bal) {
        $this->number = $num;
        $this->name = $name;
        $this->balance = $bal;
    }

    public function __toString() {
        return "Account: {$this->number}, Name: {$this->name}, Balance: €{$this->balance}";
    }
}