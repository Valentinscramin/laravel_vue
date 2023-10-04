<template>
    <div>
        <div class="alert" :class="message.status" role="alert">
            <strong>{{ message . message_header }}</strong> {{ message . message_body }}
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                //
            }
        },
        props: {
            message: {
                type: Object,
                required: false
            }
        }
    }
</script>
