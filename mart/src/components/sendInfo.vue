<template>
<div>
  <el-table
    :data="tableData"
    stripe
    style="width: 100%">
    <el-table-column
      prop="code"
      align="center"
      width="150"
      label="卡券编码">
    </el-table-column>
    <el-table-column
      prop="type2"
      align="center"
      width="120"
      label="礼券名称">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.礼券名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="name"
      align="center"
      label="提货商品"
       width="160">
  <template slot-scope="scope">
    <span style="color:#00a200">{{scope.row.提货商品}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="核销状态">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.礼券名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="配送地址"
      width="210">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.礼券名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="收件人"
      width="160">
      <template slot-scope="scope">
        <span style="display:block;">欧阳雨木</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      width="110"
      label="联系电话">
      <template slot-scope="scope">
          <span style="display:block;">133 0591 8888</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="配送状态">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.礼券名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      width="90"
      label="配送方式">
      <template slot-scope="scope">
          <span style="display:block;">第三方备货</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="配送商">
      <template slot-scope="scope">
          <span style="display:block;">顺风同城</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      width="120"
      label="配送单号">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.配送单号}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="执行人">
      <template slot-scope="scope">
        <span style="display:block;">591001</span>
        <span style="display:block;">慕荣晓晓</span>
      </template>
    </el-table-column>
    <el-table-column
    align="center"
      label="操作">
      <template slot-scope="scope">
<el-dropdown trigger="click" placement="bottom"  @command="handleCommand">
  <span class="el-dropdown-link">
    <i class="el-icon-arrow-down el-icon--right"></i>
  </span>
  <el-dropdown-menu slot="dropdown" >
    <el-dropdown-item command="1">状态更新</el-dropdown-item>
    <el-dropdown-item command="2">打印单据</el-dropdown-item>
    <el-dropdown-item command="3">配送录单</el-dropdown-item>
    <el-dropdown-item command="4">推送短信</el-dropdown-item>
    <el-dropdown-item command="5">修改编辑</el-dropdown-item>
    <el-dropdown-item command="6">取消订单</el-dropdown-item>
  </el-dropdown-menu>
</el-dropdown>
      </template>
    </el-table-column>
  </el-table>
<el-dialog title="状态更新" :visible.sync="dialogFormVisible" center>
  <el-col :span="24">
  <el-form :model="form">
    <el-col :span="12" :offset="6">
    <el-form-item label="卡券编码" label-width="120px">
      20180302059100001
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="礼券名称" label-width="120px">
      运通星  中秋礼券
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="礼券类型" label-width="120px">
      提货券
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="配送状态" label-width="120px">
      <el-select v-model="status" placeholder="">
       <el-option label="待处理" value="shanghai"></el-option>
       <el-option label="备货中" value="beijing"></el-option>
       <el-option label="待配送" value="shanghai"></el-option>
       <el-option label="已发货" value="beijing"></el-option>
      </el-select>
    </el-form-item>
    </el-col>
  </el-form>
  </el-col>
  <div slot="footer" class="dialog-footer">
    <el-button type="success" @click="dialogFormVisible = false">确 定</el-button>
  </div>
</el-dialog>
<el-dialog title="配送录单" :visible.sync="dialogForm2Visible" center>
  <el-col :span="24">
  <el-form :model="form" class="form">
    <el-col :span="12" :offset="6">
    <el-form-item label="卡券编码" label-width="120px">
      20180302059100001
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="礼券名称" label-width="120px">
      运通星  中秋礼券
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="礼券类型" label-width="120px">
      提货券
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="配送状态" label-width="120px">
      <el-select v-model="status" placeholder="">
       <el-option label="待处理" value="shanghai"></el-option>
       <el-option label="备货中" value="beijing"></el-option>
       <el-option label="待配送" value="shanghai"></el-option>
       <el-option label="已发货" value="beijing"></el-option>
      </el-select>
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="配送方式" label-width="120px">
      <el-select v-model="status" placeholder="">
       <el-option label="平台自配" value="shanghai"></el-option>
       <el-option label="第三方配送" value="beijing"></el-option>
       <el-option label="用户自提" value="shanghai"></el-option>
      </el-select>
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="配送商" label-width="120px">
      <el-select v-model="status" placeholder="">
       <el-option label="顺丰" value="shanghai"></el-option>
       <el-option label="百世汇通" value="beijing"></el-option>
       <el-option label="达达" value="shanghai"></el-option>
      </el-select>
    </el-form-item>
    </el-col>
    <el-col :span="12" :offset="6">
    <el-form-item label="配送单号" label-width="120px">
      <el-input v-model="sendNum" auto-complete="off"></el-input>
    </el-form-item>
    </el-col>
  </el-form>
  </el-col>
  <div slot="footer" class="dialog-footer">
    <el-button type="success" @click="dialogFormVisible = false">确 定</el-button>
  </div>
</el-dialog>
</div>
</template>

<script>
  export default {
    data() {
      return {
        dialogFormVisible:false,
        dialogForm2Visible:false,
        status:"",
        sendNum:"",
        tableData: [{
          code: '20180221059100001',
          type: '提货券',
          type2: '运通星 中秋礼券',
          name:"阳澄湖大闸蟹 200g x 5 01803061001",
        }]
      }
    },
      methods:{
      handleCommand(command) {
        if(command=='1'){
          this.dialogFormVisible=true
        }
        if(command=='2'){
        this.$message({
                  message: '操作成功',
                  type: 'success'
                });
        }
        if(command=='3'){
          this.dialogForm2Visible=true
        }
      }
      }
  }
</script>
