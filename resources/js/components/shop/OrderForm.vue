<template>
    <div class="orderForm">
        <form
            method="POST"
            enctype="form-data"
            action="/sklep/order"
            ref="orderForm"
            v-on:submit.prevent="nextStep()"
        >
            <input type="hidden" name="_token" :value="csrf" />
            <input
                type="hidden"
                name="basketContent"
                :value="JSON.stringify(this.basketContent)"
            />
            <input
                type="hidden"
                name="message"
                :value="this.$store.getters.getMessage"
            />

            <section class="order-form-section" v-show="step == 1">
                <h3>Dane Ogólne</h3>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name" class="col-form-label">Imię*</label>

                        <input
                            v-model="form[1].name.value"
                            id="name"
                            type="text"
                            class="form-control"
                            name="name"
                            value=""
                            required
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="surname" class="col-form-label"
                            >Nazwisko*</label
                        >

                        <input
                            v-model="form[1].surname.value"
                            id="surname"
                            type="text"
                            class="form-control"
                            name="surname"
                            value=""
                            required
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                        <!-- @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror -->
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email" class="col-form-label"
                            >Adres E-mail*</label
                        >

                        <input
                            v-model="form[1].email.value"
                            id="email"
                            type="text"
                            class="form-control"
                            name="email"
                            value=""
                            required
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone" class="col-form-label"
                            >Numer Telefonu*</label
                        >

                        <div class="d-flex">
                            <div class="input-prepend">+48</div>
                            <input
                                v-model="form[1].phone.value"
                                id="phone"
                                type="text"
                                class="form-control"
                                name="phone"
                                value=""
                                required
                                autofocus
                                @keyup.enter="nextStep()"
                            />
                        </div>
                    </div>
                </div>
            </section>

            <section class="order-form-section" v-show="step == 2">
                <h3>Adres Zamieszkania</h3>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="road" class="col-form-label">Ulica*</label>

                        <input
                            v-model="form[2].road.value"
                            id="road"
                            type="text"
                            class="form-control"
                            name="road"
                            value=""
                            required
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="houseno" class="col-form-label"
                            >Numer Domu*</label
                        >

                        <input
                            v-model="form[2].houseno.value"
                            id="houseno"
                            type="text"
                            class="form-control"
                            name="houseno"
                            value=""
                            required
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="flatno" class="col-form-label"
                            >Numer Mieszkania</label
                        >

                        <input
                            v-model="form[2].flatno.value"
                            id="flatno"
                            type="text"
                            class="form-control"
                            name="flatno"
                            value=""
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="postcode" class="col-form-label"
                            >Kod Pocztowy*</label
                        >

                        <input
                            v-model="form[2].postcode.value"
                            id="postcode"
                            type="text"
                            class="form-control"
                            name="postcode"
                            value=""
                            required
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="city" class="col-form-label"
                            >Miejscowość*</label
                        >

                        <input
                            v-model="form[2].city.value"
                            id="city"
                            type="text"
                            class="form-control"
                            name="city"
                            value=""
                            required
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="country" class="col-form-label">Kraj</label>

                        <input
                            v-model="form[2].country.value"
                            id="country"
                            type="text"
                            class="form-control"
                            name="country"
                            value="PL"
                            placeholder="Polska"
                            disabled
                            autofocus
                            @keyup.enter="nextStep()"
                        />
                        <sub style="color: white;"
                            >W przypadku zamówień zagranicznych, proszę
                            skontaktuj się z sklep@szymonreich.pl</sub
                        >
                    </div>
                </div>
            </section>

            <div class="order-form-buttons">
                <div class="form-group mb-0">
                    <button @click.prevent="prevStep" class="btn btn-primary">
                        Wróć
                    </button>
                </div>

                <div class="form-group mb-0" v-if="step != totalSteps">
                    <button
                        @click.prevent="nextStep"
                        ref="nextButton"
                        class="btn btn-primary"
                        autofocus
                        @keyup.enter="nextStep()"
                    >
                        Dalej
                    </button>
                </div>

                <div class="form-group mb-0" v-if="step == totalSteps">
                    <button
                        @click.prevent="nextStep"
                        class="btn btn-primary submit"
                        @keyup.enter="nextStep()"
                    >
                        Kupuję i płacę
                    </button>
                </div>
            </div>
        </form>

        <div ref="errorAlert" class="alert alert-warning alert-dismissible">
            <div class="error" v-for="e in errors">
                {{ e }}
            </div>
            <button
                @click.prevent="dismissAlert"
                type="button"
                class="close"
                aria-label="Close"
            >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</template>

<script>
import { component } from "vuedraggable";

export default {
    components: {},
    props: [],
    data() {
        return {
            basketContent: this.$store.getters.getBasketContents,
            csrf: document.head.querySelector('meta[name="csrf-token"]')
                .content,

            form: {
                1: {
                    name: {
                        polish: "imię",
                        value: null
                    },
                    surname: {
                        polish: "nazwisko",
                        value: null
                    },
                    email: {
                        polish: "e-mail",
                        value: null
                    },
                    phone: {
                        polish: "numer telefonu",
                        value: null
                    }
                },
                2: {
                    road: {
                        polish: "ulicę",
                        value: null
                    },
                    houseno: {
                        polish: "numer domu",
                        value: null
                    },
                    flatno: {
                        polish: "numer mieszkania",
                        value: null
                    },
                    postcode: {
                        polish: "kod pocztowy",
                        value: null
                    },
                    city: {
                        polish: "miejscowość",
                        value: null
                    },
                    country: {
                        polish: "kraj",
                        value: "Polska"
                    }
                }
            },
            step: 1,
            totalSteps: 2,
            errors: []
        };
    },
    computed: {},

    mounted() {
        this.$store.watch(state => {
            return this.$store.state.basketContent;
        });

        window.addEventListener("keypress", e => {
            if (e.key == "Enter") {
                e.preventDefault();
                this.nextStep();
            }
        });
    },

    methods: {
        prevStep: function() {
            if (this.step == 1) {
                document
                    .querySelector("section.order-products")
                    .classList.add("hidden");
                document
                    .querySelector("section.shop-products")
                    .classList.remove("hidden");
            } else {
                this.step--;
            }

            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        },
        nextStep: function() {
            var flag = false;
            this.errors = [];
            for (let k in this.form[this.step]) {
                if (
                    !this.form[this.step][k].value &&
                    k != "flatno" &&
                    k != "country"
                ) {
                    this.errors.push(
                        "Prosimy podać " + this.form[this.step][k].polish
                    );
                    flag = true;
                }
                if (k == "phone" && this.form[this.step][k].value) {
                    if (this.form[this.step][k].value.length != 9) {
                        // console.log('test');
                        this.errors.push("Niepoprawny Numer Telefonu");
                        flag = true;
                    }
                }
            }
            if (flag) {
                this.$refs.errorAlert.classList.add("show");
                return true;
            }

            this.$refs.errorAlert.classList.remove("show");

            if (this.step == this.totalSteps) {
                this.sendEnquiry();
                return true;
            }

            this.step++;

            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        },
        sendEnquiry: function() {
            this.$refs.orderForm.submit();
        },
        dismissAlert: function() {
            this.$refs.errorAlert.classList.remove("show");
        }
        // formSubmit(){
        // }
    },
    computed: {}
};
</script>
