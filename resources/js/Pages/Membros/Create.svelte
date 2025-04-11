<script>
    import { Card, CardContent, CardHeader, CardTitle } from "@/shadcn/ui/card";
    import { Button } from "@/shadcn/ui/button";
    import { Input } from "@/shadcn/ui/input";
    import { Label } from "@/shadcn/ui/label";
    import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/shadcn/ui/select";
    import { Textarea } from "@/shadcn/ui/textarea";

    let form = {
        nome: '',
        cpf: '',
        celular: '',
        restricao_alimentar: '',
        etapa_ecyd: '',
        idade: ''
    };

    const etapasECYD = [
        'Iniciante',
        'Intermediário',
        'Avançado',
        'Líder'
    ];

    async function handleSubmit() {
        try {
            const response = await fetch('/api/membros', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(form)
            });

            if (response.ok) {
                window.location.href = '/membros';
            } else {
                console.error('Erro ao cadastrar membro');
            }
        } catch (error) {
            console.error('Erro:', error);
        }
    }
</script>

<div class="container mx-auto py-8">
    <Card>
        <CardHeader>
            <CardTitle>Cadastrar Novo Membro</CardTitle>
        </CardHeader>
        <CardContent>
            <form on:submit|preventDefault={handleSubmit} class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <Label for="nome">Nome</Label>
                        <Input
                            id="nome"
                            bind:value={form.nome}
                            required
                            placeholder="Nome completo"
                        />
                    </div>
                    <div class="space-y-2">
                        <Label for="cpf">CPF</Label>
                        <Input
                            id="cpf"
                            bind:value={form.cpf}
                            required
                            placeholder="000.000.000-00"
                            maxlength="11"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <Label for="celular">Celular</Label>
                        <Input
                            id="celular"
                            bind:value={form.celular}
                            required
                            placeholder="(00) 00000-0000"
                        />
                    </div>
                    <div class="space-y-2">
                        <Label for="idade">Idade</Label>
                        <Input
                            id="idade"
                            type="number"
                            bind:value={form.idade}
                            required
                            min="0"
                        />
                    </div>
                </div>

                <div class="space-y-2">
                    <Label for="etapa_ecyd">Etapa do ECYD</Label>
                    <Select bind:value={form.etapa_ecyd} required>
                        <SelectTrigger>
                            <SelectValue placeholder="Selecione a etapa" />
                        </SelectTrigger>
                        <SelectContent>
                            {#each etapasECYD as etapa}
                                <SelectItem value={etapa}>{etapa}</SelectItem>
                            {/each}
                        </SelectContent>
                    </Select>
                </div>

                <div class="space-y-2">
                    <Label for="restricao_alimentar">Restrição Alimentar</Label>
                    <Textarea
                        id="restricao_alimentar"
                        bind:value={form.restricao_alimentar}
                        placeholder="Descreva as restrições alimentares, se houver"
                    />
                </div>

                <div class="flex justify-end">
                    <Button type="submit">Cadastrar</Button>
                </div>
            </form>
        </CardContent>
    </Card>
</div>
