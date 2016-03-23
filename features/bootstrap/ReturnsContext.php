<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class ReturnsContext implements Context, SnippetAcceptingContext
{
    /**
     * @var Purchase
     */
    private $purchase;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var ProductReturn
     */
    private $productReturn;

    private $credit;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I bought a microwave on :date for £:price
     */
    public function iBoughtAMicrowaveOnDateForPs($price, $date)
    {
        $this->product = Product::named('Microwave');
        $this->purchase = new Purchase($this->product, new Price($price), new \DateTimeImmutable($date));
    }

    /**
     * @Given I was issued a receipt with sequence number :sequenceNumber for this purchase
     */
    public function iWasIssuedAReceiptWithSequenceNumberForThisPurchase($sequenceNumber)
    {
        Receipt::issue($this->purchase, $sequenceNumber);
    }

    /**
     * @When I return the microwave on :date
     */
    public function iReturnTheMicrowaveOnThJanuary($date)
    {
        $this->productReturn = new ProductReturn($this->product, new \DateTimeImmutable($date));
    }

    /**
     * @When I provide receipt with sequence number :sequenceNumber
     */
    public function iProvideReceiptWithSequenceNumber($sequenceNumber)
    {
        $this->productReturn->provideReceipt(Receipt::issue($this->purchase, $sequenceNumber));
    }

    /**
     * @When I ask for a cash refund
     */
    public function iAskForACashRefund()
    {
        $this->credit = $this->productReturn->cashRefund();
    }

    /**
     * @Then I should be credited with £:expectedAmount
     */
    public function iShouldBeCreditedWithPs($expectedAmount)
    {
        if (new Price($expectedAmount) != $this->credit) {
            throw new LogicException('Credit does not match expected amount');
        }
    }

    /**
     * @Then the microwave should be taken back into stock
     */
    public function theMicrowaveShouldBeTakenBackIntoStock()
    {
        throw new PendingException();
    }
}
