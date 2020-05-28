# civicrm-debitcard
Provides a ledger for transactions and a page to purchase credits.

This should be considered alpha software in that there is no UI.  That said, it's been running at Fat Cat Fab Lab since Jan 2018.  This extension can be used, but know that to function as intended, a hard-coded value that needs to be changed at the top of debitcard.php.  It is also tailored to the FCFL business model, which gives members free machine time credit when they join and every time their membership renews.  It does so by regex matching for "standard" and  "commercial" to dole out different amounts.  This may not fit your org. But if your membership types don't include "standard" or "commercial", nothing will happen and you can pretend this part code doesn't exist.

<b>A real extension with UI is coming as an upgrade to this one. You can use this now and know you'll be able to get new features in the future.</b>
