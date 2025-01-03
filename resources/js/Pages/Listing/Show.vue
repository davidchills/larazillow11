<template>
	<div class="flex flex-col-reverse md:grid grid-cols-12 gap-4">
		<Box class="md:col-span-7 flex items-center w-full">
			<div class="w-full text-center font-medium text-gray-500">No Images</div>
			<img :src="listing.image" :alt="listing.title" class="w-full h-64 object-cover" />
		</Box>
		<div class="md:col-span-5 flex-col gap-4">
			<Box>
				<template #header>
					Monthly Payment
				</template>
				<Price :price="listing.price" class="text-2xl font-bold" />
				<ListingSpace :listing="listing" class="text-lg" />
				<ListingAddress :listing="listing" class="text-gray-500" />
			</Box>
			<Box>
				<template #header>
					Monthly Payment
				</template>	
				<div>
					<label class="label">Interest Rate ({{ interestRate }}%)</label>
					<input v-model="interestRate" type="range" min="0.1" max="30" step="0.1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" />

					<label class="label">Duration ({{ duration }} Years)</label>
					<input v-model.number="duration" type="range" min="03" max="35" step="1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" />					
					<div class="text-gray-600 dark:text-gray-300 mt-2">
						<div class="text-gray-400">Your Monthly Payment</div>
						<Price :price="monthlyPayment" class="text-3xl" />
					</div>

					<div class="mt-2 text-gray-500">
						<div class="flex justify-between">
							<div>Total Paid</div>
							<div>
								<Price :price="totalPaid" class="font-medium" />
							</div>
						</div>
					</div>

					<div class="mt-2 text-gray-500">
						<div class="flex justify-between">
							<div>Principal Paid</div>
							<div>
								<Price :price="listing.price" class="font-medium" />
							</div>
						</div>
					</div>

					<div class="mt-2 text-gray-500">
						<div class="flex justify-between">
							<div>Interest Paid</div>
							<div>
								<Price :price="totalInterest" class="font-medium" />
							</div>
						</div>
					</div>

				</div>	
			</Box>
		</div>
	</div>
</template>

<script setup>
	import ListingAddress from '@/Components/ListingAddress.vue';
	import ListingSpace from '@/Components/UI/ListingSpace.vue';
	import Price from '@/Components/Price.vue';
	import Box from '@/Components/UI/Box.vue';
	import { ref } from 'vue';
	import { useMonthlyPayment } from '@/Composables/useMonthlyPayment';
	const interestRate = ref(2.5);
	const duration = ref(25);
	const props = defineProps({
		listing: Object
	})
	const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, interestRate, duration);
</script>