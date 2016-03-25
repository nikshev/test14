<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Request;

class SolutionTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * Test DashboardController->Invitation
     *
     * @return void
     */
    public function testInvitation()
    {
        $requestParams = [
            'patient_id'=>1
        ];

        // POST request to your controller@action
        $response = $this->action('POST', 'DashboardController@Invitation', $requestParams);
        $this->assertResponseOk();

    }

    /**
     * Test DashboardController->Reports
     *
     * @return void
     */
    public function testReports()
    {
        $requestParams = [
            'patient_id'=>1
        ];
        // POST request to your controller@action
        $response = $this->action('POST', 'DashboardController@Reports', $requestParams);
        $this->assertResponseOk();
    }

    /**
     * Test DashboardController->PDFReport
     *
     * @return void
     */
    public function testPDFReport(){
        $requestParams = [
            'report_id'=>1,
            'test'=>1,
        ];
        // POST request to your controller@action
        $response = $this->action('GET', 'DashboardController@PDFReport', $requestParams);
        $this->assertResponseOk();
    }

    /**
     * Test DashboardController->SendByMail
     *
     * @return void
     */
    public function testSendByMail(){
        $requestParams = [
            'report_id'=>1,
            'test'=>1,
        ];
        // POST request to your controller@action
        $response = $this->action('GET', 'DashboardController@SendByMail', $requestParams);
        $this->assertResponseOk();
    }
}