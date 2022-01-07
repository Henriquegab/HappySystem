    <x-adminlte-modal id="notify" title="Aviso!" size="md" theme="danger"
        icon="fas fa-exclamation-circle" v-centered static-backdrop >
        <div style="height:50px">O pedido {{ $notification }} foi excluido!</div>
        <x-slot name="footerSlot">
        
            
            
        </x-slot>
    </x-adminlte-modal>

<button id="botao" hidden data-toggle="modal" data-target="#notify" title="Aviso!"></button>

   

        <script>

            window.onload = function(){
                document.getElementById("botao").click();
            }
            setTimeout(() => {
                document.getElementById("botao").click();
            }, 3000);
            
        </script>

    
