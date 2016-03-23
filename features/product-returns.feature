Feature: Product returns

  In order reduce the number of incorrect returns
  As a returns desk operative
  I should be guided through the returns process by the POS

  Rules:
    - A customer can't return the same product twice (fraud prevention)
    - Products cannot be returned after more than 12 months from purchase
    - Products returned less than 30 days after purchase can get cash or store credit
    - Returns processed more than 30 days after purchase can only get store credit
    - Customer must present a receipt for a return to be processed
    - Damaged products are refunded but not taken back into stock

  Background:
    Given I bought a microwave on 1st January for £100
    And I was issued a receipt with sequence number 200421445 for this purchase

  Scenario: Customer returns an item for cash less than 30 days after purchase
    When I return the microwave on 20th January
    And I provide receipt with sequence number 200421445
    And I ask for a cash refund
    Then I should be credited with £100
    And the microwave should be taken back into stock

  Scenario: Customer returns an item for store credit less than 30 days after purchase
    When I return the microwave on 20th January
    And I provide receipt with sequence number 200421445
    And I ask for a store credit refund
    Then my loyalty account should be credited with £100
    And the microwave should be taken back into stock

  Scenario: Customer returns an item for store credit more than 30 days after purchase
    When I return the microwave on 10th June
    And I provide receipt with sequence number 200421445
    And I ask for a store credit refund
    Then my loyalty account should be credited with £100
    And the microwave should be taken back into stock

  Scenario: Customer cannot return an item for cash more than 30 days after purchase
    When I try to return the microwave on 10th June
    And I provide receipt with sequence number 200421445
    And I ask for a cash refund
    Then my return should be refused
    And the microwave should not be taken back into stock

  Scenario: Customer cannot return a product with the wrong receipt
    When I try to return the microwave
    And I provide receipt with sequence number 12421425
    Then my return should be refused
    And the microwave should not be taken back into stock

  Scenario: Customer cannot return a product that is already returned
    Given I returned the microwave on 10th January with receipt 200421445
    When I try to return the microwave on 20th January
    And I provide receipt with sequence number 200421445
    Then my return should be refused
    And the microwave should not be taken back into stock

  Scenario: Customer cannot return a product more than 12 months after purchase
    When I return the microwave on 3rd January next year
    And I provide receipt with sequence number 200421445
    And I ask for a store credit refund
    Then my return should be refused
    And the microwave should not be taken back into stock

  Scenario: Customer returns a damaged item and it is not returned to stock
    When I return the microwave on 20th January
    And I provide receipt with sequence number 200421445
    And I ask for a cash refund
    Then I should be credited with £100
    But the microwave should be taken back into stock