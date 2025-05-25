<template>
    <div>
        
        <h1>Welcome to Vue + Inertia</h1>
        <p>{{ title }}</p>
        <p>Welcome, {{ user }}!</p> <!-- Displaying passed data -->
        
    </div>
</template>

<script>
export default {
    props: {
        user: String,
        title: String,
    }
}
</script>
