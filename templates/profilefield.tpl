<div id="member-credit-field">
 <h3>Machine Credit</h3>
{if !empty($my_member_credit)}
   <div>Reminder: Your Member credit is topped off each time your membership dues payments are processed.</div>
<br>
<br>
  <div>Your current Member Credit is: ${$my_member_credit}</div>
<br>
{/if}
</div>
<div id="machine-credit-field">
{if !empty($my_machine_credit)}
  <div>Your current Machine Credit is: ${$my_machine_credit}</div>
<br>
{else}
<div>Your current Machine Credit is: $0.00</div>
<br>
{/if}
</div>
<div id="total-credit-field">
{if !empty($my_total_credit)}
  <div><b>Total: ${$my_total_credit}</b></div>
<br>
{else}
<div><b>Total: $0.00</b></div>
<br>
{/if}
</div>
<script type="text/javascript">
  cj('#member-credit-field').insertAfter('#anchor')
  cj('#machine-credit-field').insertAfter('#member-credit-field')
  cj('#total-credit-field').insertAfter('#machine-credit-field')
</script>
