$(function () {
	var btnProjAdd = $('#proj-add').find('a');
	var btnProjUpdate = $('#btnUpdate');
	var btnProjDelete = $('#btnDelete');
	var mainPage = $('#main').find('.col-sm-10');
	
	//  project create
	btnProjAdd.click(function (e) {
		e.preventDefault();
		mainPage.empty();
		//  add an form
		var newForm = $('<h2 class="text-center">添加新项目</h2>' +
			'<form class="form-horizontal" method="post" action="/user/projects/create">' +
			'  <fieldset>' +
			'    <div class="form-group">' +
			'      <label for="inputProjName" class="col-lg-2 control-label">项目名称</label>' +
			'      <div class="col-lg-10">' +
			'        <input type="text" name="proj_name" class="form-control" id="inputProjName">' +
			'      </div>' +
			'    </div>' +
			'    <div class="form-group">' +
			'      <label for="inputProjDetails" class="col-lg-2 control-label">项目描述</label>' +
			'      <div class="col-lg-10">' +
			'        <textarea class="form-control" rows="3" name="proj_description" id="inputProjDetails"></textarea>' +
			'      </div>' +
			'    </div>' +
			'    <div class="form-group">' +
			'      <div class="col-lg-10 col-lg-offset-2">' +
			'        <button type="reset" class="btn btn-default">重置</button>' +
			'        <button type="submit" class="btn btn-primary">提交</button>' +
			'      </div>' +
			'    </div>' +
			'  </fieldset>' +
			'</form>');
		mainPage.append(newForm);
	});
	
	//  project delete
	btnProjDelete.click(function () {
		$.ajax({
			type: 'post',
			dataType: 'JSON',
			data: {
				'proj_id': $('h2').data('projid')
			},
			url: '/user/projects/delete',
			success: function (data) {
				var msg = $('#msg');
				if (data && data.status == 1) {
					msg.html('删除成功');
					setTimeout(function () {
						window.location.href = '/user/projects';
					}, 300);
				} else {
					msg.html('删除失败');
				}
			}
		})
	});
	
	//  project update
	btnProjUpdate.click(function () {
		$.ajax({
			type: 'post',
			dataType: 'JSON',
			data: {
				'proj_id': $('h2').data('projid'),
				'proj_name': $('#inputProjName').val(),
				'proj_description': $('#inputProjDetails').val(),
			},
			url: '/user/projects/update',
			success: function (data) {
				var msg = $('#msg');
				if (data && data.status == 1) {
					msg.html('更改成功');
					setTimeout(function () {
						window.location.href = '/user/projects';
					}, 300);
				} else {
					msg.html('更改失败, 请重试');
				}
			}
		})
	})
});