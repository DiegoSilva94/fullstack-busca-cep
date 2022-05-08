<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste Voxline</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/maska@latest/dist/maska.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Teste Pratico do Diego Silva</h1>
        </div>
    </header>
    <main id="app">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Replace with your content -->
            <div class="px-4 py-6 sm:px-0">
                <div class="pb-10">
                    <h2 class="pb-4">Exemplo em formulario:</h2>
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="animate-pulse w-full bg-blue-500 h-1" v-if="loading"></div>
                        <div class="w-full h-1" v-if="!loading"></div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="cep" class="block text-sm font-medium text-gray-700">Cep</label>
                                    <input v-model="form.cep" @keyup="buscaCep" v-maska="'#####-###'" type="text" name="cep" id="cep" autocomplete="cep" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 read-only:bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <small class="text-xs text-red-500">@{{ errorMessage }}</small>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                                    <input v-model="form.cidade" readonly type="text" name="cidade" id="cidade" autocomplete="cidade" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 read-only:bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                                    <input v-model="form.estado" readonly type="text" name="estado" id="estado" autocomplete="estado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 read-only:bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                                    <input v-model="form.bairro" :readonly="!cepValido || form.bairro !== ''" type="text" name="bairro" id="bairro" autocomplete="bairro" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 read-only:bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-4">
                                    <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                                    <input v-model="form.logradouro" :readonly="!cepValido || form.logradouro !== ''" type="text" name="logradouro" id="logradouro" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 read-only:bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="numero" class="block text-sm font-medium text-gray-700">Numero</label>
                                    <input v-model="form.numero" :readonly="!cepValido" type="text" name="numero" id="numero" autocomplete="numero" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 read-only:bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="complemento" class="block text-sm font-medium text-gray-700">Complemento</label>
                                    <input v-model="form.complemento" :readonly="!cepValido" type="text" name="complemento" id="complemento" autocomplete="complemento" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 read-only:bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button @click="salvar" :disabled="!cepValido" class="disabled:bg-gray-400 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Salvar</button>
                        </div>
                    </div>
                    <h2 class="mt-8 pb-4" v-if="salvo !== null">Exemplo de exebição de salvamento:</h2>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg" v-if="salvo !== null">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Endereço</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes do endereço salvo.</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">CEP</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"> @{{ salvo.cep }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Logradouro</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"> @{{ salvo.logradouro }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Numero</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">@{{ salvo.numero }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Complemento</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">@{{ salvo.complemento }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Bairro</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">@{{ salvo.bairro }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Cidade/Estado</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">@{{ salvo.cidade }} / @{{ salvo.estado }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Codigo IBGE da Cidade</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">@{{ salvo.ibge }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">DDD de Cobertudo</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">@{{ salvo.ddd }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Linha Unica</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @{{ salvo.logradouro }}@{{ salvo.numero? ', ' + salvo.numero: '' }}@{{ salvo.complemento? ', ' + salvo.complemento: '' }}@{{  salvo.bairro? ', ' + salvo.bairro: '' }}, @{{ salvo.cidade }} - @{{ salvo.estado }}, @{{ salvo.cep }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Link Maps</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <a class="text-blue-600 visited:text-purple-600" :href="'https://www.google.com.br/maps/search/' + salvo.logradouro + (salvo.numero? ', ' + salvo.numero: '') + (salvo.complemento? ', ' + salvo.complemento: '') + (salvo.bairro? ', ' + salvo.bairro: '') + ', ' + salvo.cidade + ' - ' + salvo.estado + ', ' + salvo.cep" target="_blank">Click aqui para abrir o Google Maps</a>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /End replace -->
        </div>
    </main>
<script>
    const { createApp } = Vue
    const app = createApp({
        data() {
            return {
                errorMessage: null,
                loading: false,
                cepValido: false,
                form: {
                    cep: '',
                    cidade: '',
                    estado: '',
                    bairro: '',
                    complemento: '',
                    numero: '',
                    logradouro: '',
                    ibge: '',
                    ddd: ''
                },
                salvo: null
            }
        },
        methods: {
            buscaCep() {
                const cep = this.form.cep.replace(/\D/g, '')
                if (cep.length !== 8) {
                    return;
                }
                this.errorMessage = null
                this.loading = true
                const instance = axios.create({
                    baseUrl: window.location.href,
                    timeout: 1000 * 5
                })
                instance
                    .get(`/busca/${cep}`)
                    .then((res) => {
                        if (res.status !== 200) {
                            throw 'Não foi possivel encontrar o cep'
                        }
                        return res.data
                    })
                    .then((res) => {
                        this.cepValido = true
                        this.form.cidade = res.localidade
                        this.form.estado = res.uf
                        this.form.bairro = res.bairro
                        this.form.complemento = res.complemento
                        this.form.logradouro = res.logradouro
                        this.form.ibge = res.ibge
                        this.form.ddd = res.ddd
                    }).catch(e => {
                        this.cepValido = false
                        this.form.cidade = ''
                        this.form.estado = ''
                        this.form.bairro = ''
                        this.form.complemento = ''
                        this.form.logradouro = ''
                        this.form.ibge = ''
                        this.form.ddd = ''
                        this.errorMessage = e.response?.data?.message || e;
                    }).finally(() => this.loading = false)
            },
            salvar() {
                this.salvo = this.form
                this.form = {
                    cep: '',
                    cidade: '',
                    estado: '',
                    bairro: '',
                    complemento: '',
                    numero: '',
                    logradouro: '',
                    ibge: '',
                    ddd: ''
                }
                this.cepValido = false
            }
        }
    }).use(Maska).mount('#app')
</script>
</body>
</html>
