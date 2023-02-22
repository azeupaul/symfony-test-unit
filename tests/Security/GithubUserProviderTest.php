<?php

namespace App\Tests\Security;

use App\Security\GithubUserProvider;
use PHPUnit\Framework\TestCase;

class GithubUserProviderTest extends TestCase
{
    public function testLoadUserByUsernameReturningAUser()
    {
        $client = $this->getMockBuilder('GuzzleHttp\Client')->disableOriginalConstructor()->getMock();
        
        $serializer = $this->getMockBuilder('JMS\Serializer\SerializerInterface')->disableOriginalConstructor()->getMock();

        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();
        
        $client->expects($this->once())->method('get')->willReturn($response);

        $streamedResponse = $this->getMockBuilder('Psr\Http\Message\StreamInterface')->getMock();
        $streamedResponse->expects($this->once())->method('getContents')->willReturn('foo');

        $response->expects($this->once())->method('getBody')->willReturn($streamedResponse);

        $userData = ['login' => 'a login', 'name' => 'user name', 'email' => 'adress@mail.com', 'avatar_url' => 'url to the avatar', 'html_url' => 'url to profile'];
        
        $serializer->expects($this->once())->method('deserialize')->willReturn($userData);

        $githubUserProvider = new GithubUserProvider($client, $serializer);
        $user = $githubUserProvider->loadUserByUsername('access_token');
    }
}