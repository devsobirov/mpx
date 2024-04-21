<!--  Initializing Global Alpine Data & Methods -->
<script>
    document.addEventListener('alpine:init', () => {

        Alpine.store('errors', {
            messages: [],
            handle(data) {
                if (data.message) this.messages.push(data.message);
                if (data.errors) {
                    for (const [key, msgs] of Object.entries(data.errors)) {
                        if (msgs && msgs.length) msgs.forEach(m => this.messages.push(m))
                    }
                }
            },
            fromResponse(errors) {
                if (errors.response && errors.response.data) {
                    return this.handle(errors.response.data)
                }

                this.messages.push(errors.message);
            }
        });
        Alpine.store('success', []); // Success messages

        Alpine.data('globalData', () => ({
            isModalOpen: false,
        }))
    })
</script>
