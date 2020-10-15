<?php
  
  /* Sugar Puppy Exception */
  class SPException extends Exception {
    public $code = 500;
    public $type = 'internal';

    public function __construct($code = 500, $type = 'internal') {
      parent::__construct();
      $this->code = $code;
      $this->type = $type;
    }

    public function __debugInfo() {
      return [
        'code' => $this->code, 
        'type' => $this->type, 
        'original' => [
          'line' => $this->line,
          'file' => $this->file,
          'message' => $this->message,
        ]
      ];
    }

    public function __toString() {
      return "SPException: {code => '{$this->code}', type => '{$this->type}'\n";
    }

    public static function catch($e, $exceptionMap = []) {
      if (!($e instanceof MVException)) {
        return [
          'status' => 500,
          'msg' => 'internal_error'
        ];
      } else {
        $exception = $exceptionMap[$e->type];
        return [
          'status' => $exception[0],
          'msg' => $exception[1]
        ];
      }
    }
  }

?>