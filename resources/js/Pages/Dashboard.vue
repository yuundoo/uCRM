<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/inertia-vue3";
import FlashMessage from "@/Components/FlashMessage.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <section class="text-gray-600 body-font">
                <img
                    src="images/main.jpg"
                    alt="Main Image Description"
                    class="object-cover w-full"
                    style="height: 300px; object-position: center"
                />
                <div class="container px-5 py-24 mx-auto">
                    <FlashMessage />
                    <div class="flex flex-wrap w-full mb-20">
                        <div class="w-full p-3 mb-6 lg:w-1/2 lg:mb-0">
                            <h1
                                class="mb-2 text-2xl font-medium text-gray-900 sm:text-3xl title-font"
                            >
                                美容院顧客管理サイト
                            </h1>
                            <div class="h-1 bg-indigo-500 rounded w-72"></div>
                        </div>
                        <p
                            class="w-full p-6 mt-4 font-semibold leading-relaxed text-gray-500"
                        >
                            ようこそ！美容室顧客管理サイトへようこそ。
                            私たちのウェブアプリケーションは、美容室業務を最適化し、顧客サービスを向上させるためのツールです。
                            サービスおよび価格設定、顧客記録および履歴追跡など、さまざまな機能を通じて業務を効率的に管理してください。
                            美容師と管理者の両方に、より良い美容室経験を提供できるようお手伝いします。
                            起動する前にログインするか、アカウントを作成してください！
                        </p>
                    </div>
                    <div class="flex flex-wrap -m-4">
                        <div
                            class="p-4 xl:w-1/4 md:w-1/2"
                            v-if="$page.props.auth.user.role === 'admin'"
                        >
                            <div class="p-6 bg-gray-100 rounded-lg">
                                <img
                                    class="object-cover object-center w-full h-40 mb-6 rounded"
                                    src="images/item.jpg"
                                    alt="content"
                                />
                                <h3
                                    class="text-xs font-medium tracking-widest text-indigo-500 title-font"
                                >
                                    タイトル
                                </h3>
                                <Link
                                    :href="route('items.index')"
                                    class="mb-4 text-lg font-medium text-gray-900 cursor-pointer title-font"
                                >
                                    商品管理
                                </Link>
                                <p class="text-base leading-relaxed">
                                    商品管理を通じて美容室で提供される様々な商品を簡単に管理してください。
                                    新しい商品を追加し、価格を更新することができます。
                                </p>
                            </div>
                        </div>
                        <div
                            class="p-4 xl:w-1/4 md:w-1/2"
                            v-if="$page.props.auth.user.role === 'admin'"
                        >
                            <div class="p-6 bg-gray-100 rounded-lg">
                                <img
                                    class="object-cover object-center w-full h-40 mb-6 rounded"
                                    src="images/purchase.jpg"
                                    alt="content"
                                />
                                <h3
                                    class="text-xs font-medium tracking-widest text-indigo-500 title-font"
                                >
                                    タイトル
                                </h3>
                                <Link
                                    :href="route('customers.index')"
                                    class="mb-4 text-lg font-medium text-gray-900 cursor-pointer title-font"
                                >
                                    顧客管理
                                </Link>
                                <p class="text-base leading-relaxed">
                                    顧客管理セクションでは、美容室の顧客の情報と履歴を整理して管理することが。
                                    顧客プロフィールを作成し、予約を管理して最高のサービスを提供してください。
                                </p>
                            </div>
                        </div>
                        <div
                            class="p-4 xl:w-1/4 md:w-1/2"
                            v-if="$page.props.auth.user.role === 'admin'"
                        >
                            <div class="p-6 bg-gray-100 rounded-lg">
                                <img
                                    class="object-cover object-center w-full h-40 mb-6 rounded"
                                    src="images/customer.jpg"
                                    alt="content"
                                />
                                <h3
                                    class="text-xs font-medium tracking-widest text-indigo-500 title-font"
                                >
                                    タイトル
                                </h3>
                                <Link
                                    :href="route('purchases.create')"
                                    class="mb-4 text-lg font-medium text-gray-900 cursor-pointer title-font"
                                >
                                    購入登録
                                </Link>
                                <p class="text-base leading-relaxed">
                                    顧客購入登録機能を使用して、顧客の購入履歴を簡単に記録してください。
                                    これにより、お客様にカスタマイズされたサービスを提供できます。
                                </p>
                            </div>
                        </div>
                        <div
                            class="p-4 xl:w-1/4 md:w-1/2"
                            v-if="$page.props.auth.user.role === 'admin'"
                        >
                            <div class="p-6 bg-gray-100 rounded-lg">
                                <img
                                    class="object-cover object-center w-full h-40 mb-6 rounded"
                                    src="images/purchaseCustomer.jpg"
                                    alt="content"
                                />
                                <h3
                                    class="text-xs font-medium tracking-widest text-indigo-500 title-font"
                                >
                                    タイトル
                                </h3>
                                <Link
                                    :href="route('purchases.index')"
                                    class="mb-4 text-lg font-medium text-gray-900 cursor-pointer title-font"
                                >
                                    購入顧客
                                </Link>
                                <p class="text-base leading-relaxed">
                                    商品購入顧客を通じて、どの顧客がどの商品を購入したかを追跡してください。
                                    これにより、在庫を管理し、特別な特典を提供することができます。
                                </p>
                            </div>
                        </div>
                        <div class="p-4 xl:w-1/4 md:w-1/2">
                            <div class="p-6 bg-gray-100 rounded-lg">
                                <img
                                    class="object-cover object-top w-full h-40 mb-6 rounded"
                                    src="images/designer.jpg"
                                    alt="content"
                                />
                                <h3
                                    class="text-xs font-medium tracking-widest text-indigo-500 title-font"
                                >
                                    タイトル
                                </h3>
                                <Link
                                    :href="route('stylelists.index')"
                                    class="mb-4 text-lg font-medium text-gray-900 cursor-pointer title-font"
                                >
                                    デザイナーご紹介/予約
                                </Link>
                                <p class="text-base leading-relaxed">
                                    うちのサロンでは、それぞれ異なる専門性と創造性を持った卓越したデザイナーたちがあなたの美しさのために最善を尽くしております。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </AuthenticatedLayout>
</template>
