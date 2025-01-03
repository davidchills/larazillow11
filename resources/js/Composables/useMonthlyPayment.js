import { computed, isRef } from 'vue';
export const useMonthlyPayment = (total, interestRate, duration) => {
	const principle = isRef(total) ? total.value : total
	const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration) * 12
	const monthlyPayment = computed(() => {
		const principle = isRef(total) ? total.value : total;
		const monthlyInterest = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12;
		const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration) * 12;
		return principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
	})

	const totalPaid = computed(() => {
		return numberOfPaymentMonths * monthlyPayment.value
	})

	const totalInterest = computed(() => {
		return totalPaid.value - principle
	})	
	return { monthlyPayment, totalPaid, totalInterest }
}