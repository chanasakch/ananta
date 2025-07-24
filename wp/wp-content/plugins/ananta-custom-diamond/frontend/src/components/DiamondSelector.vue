<template>
    <div id="diamond-selector" class="selector-wrapper">
        <h3>Select a Diamond</h3>

        <select v-model="selectedId" @change="emitSelected" class="diamond-dropdown">
            <option value=""> Choose a Diamond </option>
            <option v-for="diamond in diamonds" :key="diamond.diamond_id" :value="diamond.diamond_id">
                {{ diamond.shape }} | {{ diamond.size }} ct | ${{ Number(diamond.price_usd).toFixed(2) }}
            </option>
        </select>

        <div v-if="selectedDiamond" class="price-summary">
            <p><strong>Diamond Price:</strong> ฿{{ thb }}</p>
            <!-- <p><strong>Final Price:</strong> ฿{{ finalPrice }}</p> -->
        </div>
    </div>
</template>

<script>
export default {
    name: 'DiamondSelector',
    data() {
        return {
            diamonds: [],
            selectedId: '',
            selectedDiamond: null,
            ringPrice: 50000,
            exchangeRate: 36.5
        };
    },
    computed: {
        finalPrice() {
            if (!this.selectedDiamond) return this.ringPrice;
            const diamondTHB = Math.round(Number(this.selectedDiamond.price_usd) * this.exchangeRate);
            return this.ringPrice + diamondTHB;
        },
        usd() {
            return this.selectedDiamond ? Number(this.selectedDiamond.price_usd).toFixed(2) : '0.00';
        },
        thb() {
            return this.selectedDiamond ? Math.round(Number(this.selectedDiamond.price_usd) * this.exchangeRate) : 0;
        }
    },
    mounted() {
        fetch('/wp-json/ananta/v1/diamonds')
            .then(res => res.json())
            .then(data => (this.diamonds = data));

        this.$nextTick(() => {
            const form = document.querySelector('form.cart');
            if (form && !document.getElementById('ananta-selected-diamond')) {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.id = 'ananta-selected-diamond';
                hidden.name = 'selected_diamond';
                hidden.value = '';
                form.appendChild(hidden);
            }
        });
    },
    methods: {
        emitSelected() {
            const selected = this.diamonds.find(d => String(d.diamond_id) === String(this.selectedId));
            this.selectedDiamond = selected || null;
            window.__ananta_selected_diamond__ = selected;

            const hidden = document.querySelector('form.cart #ananta-selected-diamond');
            if (hidden) hidden.value = selected ? JSON.stringify(selected) : '';
        }
    }
};
</script>

<style scoped>
.selector-wrapper {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    max-width: 400px;
}

.diamond-dropdown {
    padding: 8px;
    width: 100%;
    font-size: 14px;
    margin-bottom: 10px;
    border-radius: 4px;
    border: 1px solid #aaa;
}

.price-summary {
    margin-top: 10px;
    font-size: 16px;
    line-height: 1.5;
}
</style>
