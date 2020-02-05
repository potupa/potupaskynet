'use strict'

let tariff = document.querySelectorAll('.tariff');
let tariffItem = tariff[0];
let period = document.querySelectorAll('.period');
let periodItem = period[0];
let detail = document.querySelectorAll('.detail');
let back = document.querySelector('.btn-back');

//клик по тарифу
for (let i = 0; i < tariff.length; i++) {
	tariff[i].addEventListener('click', function(){
		back.querySelector('span').innerText = `Тариф "${this.getAttribute('data-title')}"`;
		back.classList.remove('hidden');
		document.querySelector('.tariffs').classList.add('hidden');
		for (let i = 0; i < period.length; i++) {
			if (this.getAttribute('data-title') === period[i].getAttribute('data-title')) {
				period[i].classList.remove('hidden');
			}
		}
		this.classList.add('active');
		tariffItem = this; 
	});
};

// клик по выбору периода
for (let i = 0; i < period.length; i++) {
	period[i].addEventListener('click', function(){
		back.querySelector('span').innerText = 'Выбор тарифа';
		for (let i = 0; i < period.length; i++) {
			period[i].classList.add('hidden');
		}
		for (let i = 0; i < detail.length; i++) {
			if (this.getAttribute('data-id') === detail[i].getAttribute('data-id')) {
				detail[i].classList.remove('hidden');
			}
		}
		this.classList.add('active');
		periodItem = this; 
	});
};

// кнопка назад
back.addEventListener('click', function(){
	if (periodItem.classList.contains('active')) {
		for (let i = 0; i < period.length; i++) {
			periodItem.classList.remove('active');
			if (tariffItem.getAttribute('data-title') === period[i].getAttribute('data-title')) {
				period[i].classList.remove('hidden');
			}
		};
		back.classList.remove('hidden');
		back.querySelector('span').innerText = `Тариф "${tariffItem.getAttribute('data-title')}"`;
		for (let i = 0; i < detail.length; i++) {
			detail[i].classList.add('hidden');
		};
	} else {
		back.classList.add('hidden');
		for (let i = 0; i < period.length; i++) {
			period[i].classList.add('hidden');
		};
		document.querySelector('.tariffs').classList.remove('hidden');
	}
});
