<template>
	<div>You need to be verified</div>
	<div>
		<Link 
			:href="route('verification.send')" 
			method="post" 
			as="button" 
			class="text-indigo-600 dark:text-indigo-400">
			Resend verification email
		</Link>
	</div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>