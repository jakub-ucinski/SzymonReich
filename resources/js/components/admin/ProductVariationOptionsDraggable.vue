<template>
    <div class="mt-4" id="product-variation-options-table">
        <div class="d-flex align-items-center justify-content-between">
            <h5>{{ this.productvariationcategory.title }}</h5>
            <a @click="addAnother" type="button" class="button">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <table class="draggable-table">
            <colgroup>
                <col />
                <col />
                <col />
            </colgroup>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Options</th>
                    <th>Sort</th>
                </tr>
            </thead>
            <draggable
                :list="productVariationOptionsNew"
                ghost-class="ghost"
                :options="{ animation: 200, handle: '.my-handle' }"
                :element="'tbody'"
                @change="update"
            >
                <tr
                    v-for="(variationOption,
                    index) in productVariationOptionsNew"
                >
                    <td>{{ variationOption.title }}</td>

                    <td class="d-flex">
                        <form
                            :action="
                                '/admin/variationoption/' + variationOption.id
                            "
                            method="post"
                        >
                            <input
                                type="hidden"
                                name="_method"
                                value="DELETE"
                            />
                            <input type="hidden" name="_token" :value="csrf" />

                            <button type="submit" class="button mr-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <i class="fas fa-bars my-handle"></i>
                    </td>
                </tr>

                <tr
                    id="hidden"
                    :for="this.productvariationcategory.id"
                    style="display:none;"
                >
                    <td>
                        <div class="input-group mb-3">
                            <input
                                name="title"
                                id="title-input"
                                type="text"
                                class="form-control"
                                placeholder="Title"
                                aria-label="Title"
                                aria-describedby="basic-addon1"
                            />
                        </div>
                    </td>

                    <td class="d-flex">
                        <button
                            @click="addLast()"
                            type="submit"
                            class="button mr-2"
                        >
                            <i class="fas fa-plus"></i>
                        </button>

                        <button
                            @click="removeLast()"
                            type="submit"
                            class="button mr-2"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                    <td>
                        <i class="fas fa-bars my-handle"></i>
                    </td>
                </tr>
            </draggable>
        </table>
    </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
    components: {
        draggable
    },
    props: ["product", "productvariationcategory", "productvariationoptions"],
    data() {
        return {
            productVariationOptionsNew: Object.keys(
                this.productvariationoptions
            ).map(i => this.productvariationoptions[i]),
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        };
    },

    methods: {
        update() {
            this.productVariationOptionsNew.map(
                (productVariationOptionsNew, index) => {
                    productVariationOptionsNew.order = index + 1;
                }
            );

            axios.put(
                "/admin/variationcategories/" +
                    this.productvariationcategory.id +
                    "/variationoption/updateall",
                {
                    productvariationoptions: this.productVariationOptionsNew
                }
            );
        },

        addAnother() {
            document.querySelector(
                '#product-variation-options-table #hidden[for="' +
                    this.productvariationcategory.id +
                    '"]'
            ).style.display = "table-row";
        },

        removeLast() {
            document.querySelector(
                '#product-variation-options-table #hidden[for="' +
                    this.productvariationcategory.id +
                    '"]'
            ).style.display = "none";
        },

        addLast() {
            if (typeof this.productVariationOptionsNew == "undefined") {
                var order = 1;
            } else {
                var order = this.productVariationOptionsNew.length;
            }
            axios
                .post(
                    "/admin/variationcategories/" +
                        this.productvariationcategory.id +
                        "/variationoption",
                    {
                        title: document.querySelector(
                            '#product-variation-options-table #hidden[for="' +
                                this.productvariationcategory.id +
                                '"] #title-input'
                        ).value,
                        order: order
                    }
                )
                .then(response =>
                    this.productVariationOptionsNew.push(response.data)
                );

            document.querySelector(
                '#product-variation-options-table #hidden[for="' +
                    this.productvariationcategory.id +
                    '"]'
            ).style.display = "none";
        }
    }
};
</script>
