<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\User;

class InvoiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessInvoicesView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/invoices')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessInvoicesView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/invoices')
           ->assertResponseStatus('403');
    }

    public function testInvoicesViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/invoices')
           ->see('Invoices');
    }

    public function testNewInvoiceWithoutAttachment()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/invoices')
           ->see('Invoices')
           ->type('INV123', 'invoice_number')
           ->type('PO456', 'order_number')
           ->type('1999.99', 'total')
           ->select(1, 'division_id')
           ->select(1, 'supplier_id')
           ->type('2016/06/06', 'invoiced_date')
           ->press('Add New Invoice')
           ->seePageIs('/invoices')
           ->see('Successfully created')
           ->seeInDatabase('invoices', ['invoice_number' => 'INV123', 'order_number' => 'PO456', 'total' => '1999.99', 'division_id' => 1, 'supplier_id' => 1, 'invoiced_date' => '2016/06/06']);
    }

    public function testNewInvoiceWithAttachment()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $path = storage_path('testing/test.pdf');
      $original_name = 'pdf.pdf';
      $mime_type = 'application/pdf';
      $size = 7945;
      $error = null;
      $test = true;

      $file = new UploadedFile($path, $original_name, $mime_type, $size, $error, $test);

      $this->actingAs($user)
           ->visit('/invoices')
           ->see('Invoices')
           ->type('TestInvoice123', 'invoice_number')
           ->type('PO456', 'order_number')
           ->type('1999.99', 'total')
           ->select(1, 'division_id')
           ->select(1, 'supplier_id')
           ->type('2016/06/06', 'invoiced_date')
           ->attach('storage/testing/test.pdf', 'file')
           ->press('Add New Invoice')
           ->seePageIs('/invoices')
           ->see('Successfully created')
           ->seeInDatabase('invoices', ['invoice_number' => 'TestInvoice123', 'order_number' => 'PO456', 'total' => '1999.99', 'division_id' => 1, 'supplier_id' => 1, 'invoiced_date' => '2016/06/06'])
           ->assertFileExists('storage/app/invoices/TestInvoice123.pdf');

      Storage::delete('invoices/TestInvoice123.pdf');
    }

    public function testEditInvoiceWithAttachment()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $path = storage_path('testing/test.pdf');
      $original_name = 'pdf.pdf';
      $mime_type = 'application/pdf';
      $size = 7945;
      $error = null;
      $test = true;

      $file = new UploadedFile($path, $original_name, $mime_type, $size, $error, $test);

      $this->actingAs($user)
           ->visit('/invoices')
           ->see('Invoices')
           ->type('TestInvoice123', 'invoice_number')
           ->type('PO456', 'order_number')
           ->type('1999.99', 'total')
           ->select(1, 'division_id')
           ->select(1, 'supplier_id')
           ->type('2016/06/06', 'invoiced_date')
           ->attach('storage/testing/test.pdf', 'file')
           ->press('Add New Invoice')
           ->seePageIs('/invoices')
           ->see('Successfully created')
           ->seeInDatabase('invoices', ['invoice_number' => 'TestInvoice123', 'order_number' => 'PO456', 'total' => '1999.99', 'division_id' => 1, 'supplier_id' => 1, 'invoiced_date' => '2016/06/06'])
           ->assertFileExists('storage/app/invoices/TestInvoice123.pdf');

      $invoice = App\Invoice::get()->last();

      $this->actingAs($user)
           ->visit('/invoices/' . $invoice->id . '/edit')
           ->see('TestInvoice123')
           ->type('TestInvoice456', 'invoice_number')
           ->press('Edit Invoice')
           ->seePageIs('/invoices')
           ->see('Successfully updated')
           ->seeInDatabase('invoices', ['invoice_number' => 'TestInvoice456']);

      $this->assertFileNotExists('storage/app/invoices/TestInvoice123.pdf');

      $this->assertFileExists('storage/app/invoices/TestInvoice456.pdf');

      Storage::delete('invoices/TestInvoice456.pdf');
    }
}
