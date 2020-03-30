<template>
    <div class="dashboard__users-item">
        <button class="dashboard__user dashboard__user-trigger" @click="$emit('showInsertForm')">                    
            <app-icon icon="plus" size="5x" />
        </button>
    </div>
</template>

<script>
    export default {
        name: "insert-commission-member-button"
    }
</script>

     