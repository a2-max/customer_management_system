const otherBtn = document.querySelector('.other');
const otherItems = document.querySelector('.other-item');
const expenses = document.querySelector('#expenses');
const installCharge = document.querySelector('#installCharge');
const serviceCharge = document.querySelector('#serviceCharge');
const recharge = document.querySelector('#recharge');
const other1 = document.querySelector('#other1');
const other2 = document.querySelector('#other2');
const other3 = document.querySelector('#other3');
const other4 = document.querySelector('#other4');
const paid = document.querySelector('#paid_amount');
const classToogle = document.querySelector('.showtoogle');

otherBtn.addEventListener('click', () => {
    otherItems.classList.toggle("showtoogle");
});

function inputfunc() {

    expenses.innerHTML = (parseFloat(installCharge.value) + parseFloat(serviceCharge.value) + parseFloat(recharge.value)
        + parseFloat(other1.value) + parseFloat(other2.value) + parseFloat(other3.value) + parseFloat(other4.value)
        - parseFloat(paid.value));
};