{* template block that contains the new field *}
<div id="member-credit-field">
{if !empty($form.my_member_credit.label)}
   <div>Reminder:Reminder: Your Member credit is topped off each time your membership dues payments are processed.</div> 
<br>
<br>
  <div>Your current Member Credit is: ${$form.my_member_credit.label}</div>
<br>
{/if}
</div>
<div id="machine-credit-field">
{if !empty($form.my_machine_credit.label)}
  <div>Your current Machine Credit is: ${$form.my_machine_credit.label}</div>
<br>
{else}
<div>Your current Machine Credit is: $0.00</div>
<br>
{/if}
</div>
<div id="total-credit-field">
{if !empty($form.my_member_credit.label)}
<br>  <div><b>Total: ${$form.my_total_credit.label}</b></div>
<br>
{/if}
</div>

{* reposition the above block after #someOtherBlock *}
<script type="text/javascript">
  cj('#member-credit-field').insertAfter('#intro_text')
  cj('#machine-credit-field').insertAfter('#member-credit-field')
  cj('#total-credit-field').insertAfter('#machine-credit-field')
</script>

