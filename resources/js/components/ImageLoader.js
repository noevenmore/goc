import React from 'react';
import ReactDOM from 'react-dom';

class ProgressBar extends React.Component
{
    constructor(props)
    {
        super(props);
    }

    render()
    {
        let style1 = {'visibility': this.props.visible?'visible':'hidden'};
        let style2 = {width:this.props.now+'%'};

        return (
            <div className="progress" style={style1}>
                <div className="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style={style2} aria-valuenow={this.props.now} aria-valuemin="0" aria-valuemax="100">{this.props.now}%</div>
            </div>
        );
    }
}

class OneImage extends React.Component
{
    constructor(props)
    {
        super(props);

        this.onClickDelete = this.onClickDelete.bind(this);
    }

    onClickDelete()
    {
        this.props.onClickDelete(this.props.src);
    }

    render()
    {
        let const_path = '/upload/images/thumbs/';
        let style = {right:0,top:2,cursor:'pointer'};

        return (
            <div className="text-center">
                <div onClick={this.onClickDelete} style={style} className="position-absolute px-1 mr-4 bg-light text-danger"><strong>[X]</strong></div>
                <img className="img-thumbnail w-100" src={const_path+this.props.src} alt={this.props.src.toString()}/>
            </div>
        );
    }
}

class Images extends React.Component
{
    constructor(props)
    {
        super(props);
    }

    render()
    {
        let lst = this.props.list.map(el =>
            <div key={el.toString()} className="col-lg-3 col-md-4 col-sm-12">
                <OneImage onClickDelete={this.props.onClickDelete} src={el}/>
            </div>);

        return (
            <div className="row">
                {lst}
            </div>
        );
    }
}

class ImageLoader extends React.Component
{
    constructor(props)
    {
        super(props);

        this.state={
            label_list:['Выбрать файл','Загрузить','Все файлы должны быть изображениями'],
            error_message:[],
            input_value:'',
            file_list:[],
            all_ok: true,
            type:this.props.type,
            tag:this.props.tag,
            loaded_images: [],
            progress_value:0,
            show_progress:false
        }

        this.btnSelect = this.btnSelect.bind(this);
        this.onChangeFile = this.onChangeFile.bind(this);
        this.btnLoad = this.btnLoad.bind(this);
        this.loadComplete = this.loadComplete.bind(this);
        this.onProgress = this.onProgress.bind(this);
        this.deleteImage = this.deleteImage.bind(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    componentDidMount()
    {
        if (this.props.list)
        {
            var images = this.props.list.split(';');
            var images_list = new Array;

            for (let i=0;i<images.length;i++)
            {
                if (images[i]) images_list.push(images[i]);
            }

            this.setState({loaded_images:images_list});
        }
    }

    btnSelect(e)
    {
        e.preventDefault();
        $('#file_input').click();
    }

    onChangeFile(e)
    {
        var new_list=[];
        let all_ok = true;

        for (let i=0;i<e.target.files.length;i++)
        {
            let file = e.target.files[i];
            let ext = file.name.split('.').pop();

            if (!ext.match('jpg|jpeg|png'))
            {
                all_ok = false;
            }

            new_list.push(file.name);
        }

        this.setState({file_list:new_list,all_ok});
    }

    loadComplete(data)
    {
        let res = JSON.parse(data.responseText);

        if ( res.success != true)
        {
            let err_message = new Array;
            err_message.push(res.message);

            Object.keys(res.errors).map(err =>{
                err_message.push(res.errors[err]);
            });

            this.setState({error_message:err_message,show_progress:false})

            return;
        }

        let images_list=this.state.loaded_images;

        for (let i=0;i<res.image.length;i++)
        {
            images_list.push(res.image[i]);
        }

        this.setState({loaded_images:images_list,file_list:[],show_progress:false,error_message:[]})
    }

    onProgress(e)
    {
        var now = Math.trunc((e.loaded/e.total) * 100);

        this.setState({progress_value:now});
    }

    btnLoad(e)
    {
        e.preventDefault();

        var self = this;

        let fd = new FormData;

        fd.append('is_main',this.state.is_main);
        fd.append('type',this.state.type);
        fd.append('tag',this.state.tag);

        let files = $('#file_input').get(0);

        for (let i=0;i<files.files.length;i++)
        {
            fd.append('image['+i+']',files.files[i]);
        }

        this.setState({show_progress:true,progress_value:0});

        $.ajax({
            type:'POST',
            url:'/admin/loadimage',
            data: fd,
            processData:false,
            contentType:false,
            mimeType:'multipart/form-data',
            async: true,
            xhr: function(){
                var myxhr = new XMLHttpRequest;

                myxhr.upload.addEventListener("progress",ev=>self.onProgress(ev),false);

                return myxhr;
            },
            complete: function(data)
            {
                self.loadComplete(data);
            }
        });
    }

    deleteImage(filename)
    {
        let new_loaded_images_list = new Array;
        
        this.state.loaded_images.map(el=>{
            if (el != filename)
            {
                new_loaded_images_list.push(el);
            }
        });

        $.ajax(
            {
                url:'/admin/deleteimage',
                data: {
                    'filename':filename
                },
                type:'post',
                async:false,
            }
        );

        this.setState({loaded_images:new_loaded_images_list});
    }

    render()
    {
        let all_ok_window;
        let error_window;
        const list_of_files = this.state.file_list.map((el) => <li key={el.toString()}>{el}</li> );

        if (this.state.all_ok)
        {
            if (this.state.file_list.length > 0) all_ok_window = <button className="btn btn-primary btn-block" onClick={this.btnLoad}>{this.state.label_list[1]}</button>;
        } else
        {
            all_ok_window = <p className="text-danger"><strong>{this.state.label_list[2]}</strong></p>;  
        }

        if (this.state.error_message.length>0)
        {
            let error_window_list = this.state.error_message.map(el=><li key={el.toString()}>{el}</li>);

            error_window = <div className="alert alert-danger mt-2 pb-0" role="alert"><ul>{error_window_list}</ul></div>
        } else error_window=null;

        return (
            <div className="text-center">
                <input id="file_input" name="file_input[]" multiple type="file" accept=".png, .jpg, .jpeg" onChange={this.onChangeFile} hidden/>

                <div className="m-2">
                    <button className="btn btn-primary" onClick={this.btnSelect}>{this.state.label_list[0]}</button>

                    <ul className="text-left">{list_of_files}</ul>

                    {all_ok_window}
                    
                    {error_window}

                    <ProgressBar visible={this.state.show_progress} now={this.state.progress_value} />

                    <Images onClickDelete={this.deleteImage} list={this.state.loaded_images}/>
                </div>
            </div>
        );
    }
}

export default ImageLoader;

$.each($('#imageloader'), function(index, element){
    var image_list = $(element).data('list');
    var param_type = $(element).data('type');
    var param_tag = $(element).data('tag');

    if (param_tag === undefined)
    {
        param_tag = '';
    }

    ReactDOM.render(<ImageLoader list={image_list} type={param_type} tag={param_tag}/>, element);
});