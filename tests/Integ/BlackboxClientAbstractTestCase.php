<?php

namespace Vws\Test\Integ;

use Vws\Blackbox\Exception\BlackboxException;
use Vws\Result;

class BlackboxClientAbstractTestCase extends AbstractTestCase
{
    /**
     * validate response header and body by given value
     *
     * @param   string   $operation  Name of the operation (e.g. postProduct)
     * @param   array    $data       Operation data
     *
     * @uses    $actualResponse, $expectedResponse
     */
    public function validate($operation, $data)
    {
        try {
            $this->actualResponse = $this->getResponse($operation, $data);

            $this->validateStatusCode(201);
            $this->validateEntityListCount();

            if (isset($this->expectedResponse['Messages'])) {
                $this->validateMessagesNumber();
                $this->validateMessages();
            } else {
                $this->validateMessagesNumber(false);
            }

        } catch (BlackboxException $e) {
            $this->validateStatusCode(400);

            $responseBody = json_decode(
                $e->getResponse()->getBody()->__toString(),
                true
            );
            $this->actualResponse = new Result($responseBody);

            $this->validateEntityListCount();

            if (isset($this->expectedResponse['Messages'])) {
                $this->validateMessagesNumber();
                $this->validateMessages();
            } else {
                $this->validateMessagesNumber(false);
            }

        } catch (\Exception $e) {
            $this->fail('Failed with php Exception ' . $e->getMessage());
        }
    }

    /**
     * Get response from given operation and data
     *
     * @param   string   $operation  Name of the operation (e.g. postProduct)
     * @param   array    $data       Operation data
     *
     * @return  Vws\Result
     */
    private function getResponse($operation, $data)
    {
        return $this->client->{$operation}($data);
    }

    /**
     * Assert response header status code
     *
     * @param integer $actual actual status code
     */
    private function validateStatusCode($actual)
    {
        $this->assertSame(
            $this->expectedResponse['StatusCode'],
            $actual,
            self::getCustomErrorMessage(
                $this->expectedResponse['FunctionName'],
                'HeaderStatusCode',
                $this->expectedResponse['StatusCode'],
                $actual
            )
        );
    }

    /**
     * Assert response body EntityList number
     */
    private function validateEntityListCount()
    {
        $this->assertCount(
            $this->expectedResponse['EntityListCount'],
            ($this->actualResponse->search('EntityList'))
            ? $this->actualResponse->search('EntityList')
            : [],
            self::getCustomErrorMessage(
                $this->expectedResponse['FunctionName'],
                'EntityList',
                $this->expectedResponse['EntityListCount'],
                count($this->actualResponse->search('EntityList'))
            )
        );
    }

    /**
     * Traverse expected messages and validate them
     */
    private function validateMessages()
    {
        foreach ($this->expectedResponse['Messages'] as $key => $message) {
            foreach ($message as $name => $value) {
                if ($name === 'Message' || $name === 'Description') {
                    $this->validateMessagesEntryWithRegEx($value, $key, $name);
                } else {
                    $this->validateMessageEntry($value, $key, $name);
                }
            }
        }
    }

    /**
     * Assert response body messages message/description entry
     *
     * @param string    $value      expected string
     * @param integer   $counter    key of the array
     * @param string    $name       property name
     */
    private function validateMessagesEntryWithRegEx($value, $key, $name)
    {
        $this->assertRegExp(
            '/' . $value . '/',
            $this->actualResponse->search('Messages['.$key.'].' . $name),
            self::getCustomErrorMessage(
                $this->expectedResponse['FunctionName'],
                'Messages',
                $value,
                $this->actualResponse->search('Messages['.$key.'].' . $name),
                'Messages['.$key.'].' . $name
            )
        );
    }

    /**
     * Assert response body messages code, severity entry
     *
     * @param integer   $value      expected integer
     * @param integer   $counter    key of the array
     * @param string    $name       property name
     */
    private function validateMessageEntry($value, $counter, $name)
    {
        $this->assertEquals(
            $value,
            $this->actualResponse->search('Messages['.$counter.'].' . $name),
            self::getCustomErrorMessage(
                $this->expectedResponse['FunctionName'],
                'Messages',
                $value,
                $this->actualResponse->search('Messages['.$counter.'].' . $name),
                'Messages['.$counter.'].' . $name
            )
        );
    }

    /**
     * Validate response body messages number
     */
    private function validateMessagesNumber($expectedMessages = true)
    {
        if ($expectedMessages) {
            $this->validateExpectedMessagesTrue();
        } else {
            $this->validateExpectedMessagesFalse();
        }
    }

    /**
     * Assert expected messages number with response body messages number
     */
    private function validateExpectedMessagesTrue()
    {
        $this->assertEquals(
            count($this->expectedResponse['Messages']),
            count($this->actualResponse->search('Messages')),
            self::getCustomErrorMessage(
                $this->expectedResponse['FunctionName'],
                'Messages',
                count($this->expectedResponse['Messages']),
                count($this->actualResponse->search('Messages'))
            )
        );
    }

    /**
     * Assert empty expected messages number with response body messages number
     */
    private function validateExpectedMessagesFalse()
    {
        $this->assertEquals(
            count($this->actualResponse->search('Messages')),
            0,
            self::getCustomErrorMessage(
                $this->expectedResponse['FunctionName'],
                'Messages',
                'more Entry than',
                '',
                count($this->actualResponse->search('Messages'))
            )
        );
    }
}
