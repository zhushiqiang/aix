<?php

namespace Xinchan\Aix;

use Xinchan\Aix\Exceptions\HttpException;
use GuzzleHttp\Client;

class Company
{
    protected $access_token;
    protected $guzzleOptions = [];

    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function create(array $company)
    {
        $url = env('AIX-URL') . '/api/company';

        try {
            $response = $this->getHttpClient()->post($url, [
                'body' => json_encode($company, JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    public function update(string $uuid, array $company)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid;
        try {
            $response = $this->getHttpClient()->put($url, [
                'body' => json_encode($company, JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    public function detail(string $uuid)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid;
        try {
            $response = $this->getHttpClient()->get($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    public function authorization(string $uuid, int $type)
    {
        $url = env('AIX-URL') . '/api/company/authorization/' . $uuid . '?type=' .$type;
        try {
            $response = $this->getHttpClient()->get($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //同步
    public function synchronousWxDepAndPerson(string $uuid)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/synchronous_wx_dep_and_person';
        try {
            $response = $this->getHttpClient()->get($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //成员列表
    public function employeeList(string $uuid, $department_id)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/department/' . $department_id . '/employee';
        try {
            $response = $this->getHttpClient()->get($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //成员删除
    public function employeeDelete(string $uuid, $userids)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/employee/delete';
        try {
            $response = $this->getHttpClient()->delete($url, [
                'body' => json_encode(['userids' => $userids], JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //成员添加
    public function employeeCreate(string $uuid,array $employee)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/employee';
        try {
            $response = $this->getHttpClient()->post($url, [
                'body' => json_encode($employee, JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //成员编辑
    public function employeeEdit(string $uuid, int $employee_id,array $employee)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/employee/' . $employee_id;

        try {
            $response = $this->getHttpClient()->put($url, [
                'body' => json_encode($employee, JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //成员详情
    public function employeeDetail(string $uuid, int $employee_id)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/employee/' . $employee_id;

        try {
            $response = $this->getHttpClient()->get($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //部门修改
    public function departmentEdit(string $uuid, int $department_id ,array $department)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/department/' . $department_id;
        try {
            $response = $this->getHttpClient()->put($url, [
                'body' => json_encode($department, JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //部门列表
    public function departmentList(string $uuid, int $department_id)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/department/' . $department_id;
        try {
            $response = $this->getHttpClient()->get($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //部门删除
    public function departmentDelete(string $uuid, int $department_id)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/department/' . $department_id;
        try {
            $response = $this->getHttpClient()->get($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //部门添加
    public function department(string $uuid, int $parent_id, string $name)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/department/';

        try {
            $response = $this->getHttpClient()->post($url, [
                'body' => json_encode(['parent_id' => $parent_id, 'name' => $name], JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //话术修改
    public function replyEdit(string $uuid, int $reply_id, array $reply)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/reply/' . $reply_id;

        try {
            $response = $this->getHttpClient()->put($url, [
                'body' => json_encode($reply, JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //删除话术
    public function replyDelete(string $uuid, int $reply_id)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/reply/' . $reply_id;

        try {
            $response = $this->getHttpClient()->delete($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //添加话术
    public function replyCreate(string $uuid, array $reply)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/reply/';

        try {
            $response = $this->getHttpClient()->post($url, [
                'body' => json_encode($reply, JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //话术列表
    public function replyList(string $uuid, $page = 1, $reply_group_id = 0)
    {
        $url = env('AIX-URL') . '/api/company/' . $uuid . '/reply/' . $reply_group_id . '?page=' .$page;

        try {
            $response = $this->getHttpClient()->get($url, [
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
    //雷达权限开启关闭
    public function modify_radar(string $uuid,string $ids, int $status, int $type)
    {
        $url = env('AIX-URL') . '/api/company/modify_radar/' . $uuid;

        try {
            $response = $this->getHttpClient()->put($url, [
                'body' => json_encode(['ids' => $ids, 'status' => $status, 'type' => $type], JSON_UNESCAPED_UNICODE),
                //content-type为application/json
                'headers' => ['content-type' => 'application/json', 'Authorization' => 'Bearer ' . $this->access_token]
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
        return \json_decode($response, true);
    }
}