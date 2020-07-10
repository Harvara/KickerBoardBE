<?php


namespace Domain;


class DependencyPluginTransferMessage
{
    /**
     * @var bool
     */
    private $runWithoutError;

    /**
     * @var string
     */
    private $resultMessage;

    /**
     * @var array
     */
    private $errorMessages = [];


    /**
     * @var array
     */
    private $data =   [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * @param string $key
     * @param $data
     */
    public function appendData(string $key, $data):void {
        $this->data[$key] = $data;
    }

    /**
     * @param string $key
     */
    public function getData(string $key){
        return $this->data[$key];
    }


    /**
     * @return bool
     */
    public function isRunWithoutError(): bool
    {
        return $this->runWithoutError;
    }

    /**
     * @param bool $runWithoutError
     */
    public function setRunWithoutError(bool $runWithoutError): void
    {
        $this->runWithoutError = $runWithoutError;
    }

    /**
     * @return string
     */
    public function getResultMessage(): string
    {
        return $this->resultMessage;
    }

    /**
     * @param string $resultMessage
     */
    public function setResultMessage(string $resultMessage): void
    {
        $this->resultMessage = $resultMessage;
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    /**
     * @param array $errorMessages
     */
    public function addErrorMessage(string $errorMessage): void
    {
        array_push($errorMessages, $errorMessage);
    }



}
