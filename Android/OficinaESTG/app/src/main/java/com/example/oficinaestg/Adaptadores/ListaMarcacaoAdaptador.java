package com.example.oficinaestg.Adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.oficinaestg.Modelos.Marcacao;
import com.example.oficinaestg.R;

import java.util.ArrayList;

public class ListaMarcacaoAdaptador extends BaseAdapter {

   private Context context;
   private LayoutInflater layoutInflater;
   private ArrayList<Marcacao> marcacoes;

    public ListaMarcacaoAdaptador(Context context, ArrayList<Marcacao> marcacoes) {
        this.context = context;
        this.marcacoes = marcacoes;
    }

    @Override
    public int getCount() {
        return marcacoes.size();
    }

    @Override
    public Object getItem(int position) {
        return marcacoes.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup viewGroup) {
        if(layoutInflater == null){
            layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if(convertView == null){
            convertView = layoutInflater.inflate(R.layout.item_lista_marcacao, null);
        }

        ListaMarcacaoAdaptador.ViewHolderLista viewHolderLista = (ListaMarcacaoAdaptador.ViewHolderLista) convertView.getTag();
        if(viewHolderLista == null){
            viewHolderLista = new ListaMarcacaoAdaptador.ViewHolderLista(convertView);
            convertView.setTag(viewHolderLista);
        }

        viewHolderLista.update(marcacoes.get(position));
        return convertView;
    }

    private class ViewHolderLista{

        private TextView Tipo, Data, Estado;

        public ViewHolderLista(View convertView){
            Tipo = convertView.findViewById(R.id.textView_tipoMarcacao);
            Data = convertView.findViewById(R.id.textView_dataMarcacao);
            Estado = convertView.findViewById(R.id.textView_estado);

        }

        public void update(Marcacao marcacao){
            Tipo.setText(marcacao.getTipoMarcacao());
            Data.setText(marcacao.getDataMarcacao());
            Estado.setText(marcacao.getEstadoMarcacao());
        }

    }
}
