<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <blockquote class="blockquote text-center">
                <p class="mb-0">Loans</p>
                <footer id="ft1" class="blockquote-footer">Shows the amount of borrowed books in the given dates</footer>
              </blockquote>
                <div id="loanChart">
                    <ve-line :data="chartData"></ve-line>
                </div>
                <blockquote class="blockquote text-center">
                  <p class="mb-0">Returns</p>
                  <footer id="ft2" class="blockquote-footer">Shows the amount of borrowed and returned books in the given dates</footer>
                </blockquote>
                <div id="returnChart">
                    <ve-bar :data="chartData"></ve-bar>
                </div>
            </div>
        </div>
    </div>
    
<script>          
    let header = {
        _token: '{{ csrf_token() }}'
    };
    let loanData = []
    let returnData = [];
    async function get() {
        const response = await axios.get('{{url('data ')}}', header);
        for (let i = 0; i < response.data['loans'].length; i++) {
            loanData.push(response.data['loans'][i]);
        }
        for (let i = 0; i < response.data['returns'].length; i++) {
            returnData.push(response.data['returns'][i]);
        }
        returnData.forEach(returned => {
            loanData.forEach(loan => {
                if(returned.date == loan.date)
                    returned.loans = loan.loans
                else
                  returned.loans = 0
            });
        });
        if (loanData.length == 0) {
            let loanRecords = document.getElementById('ft1');
            loanRecords.innerHTML += ' | There are currently 0 records';
        }
        if (returnData.length == 0) {
            let returnRecords = document.getElementById('ft2');
            returnRecords.innerHTML += ' | There are currently 0 records';
        }
      }
    get();
    new Vue({
        el: '#loanChart',
        data: function() {
            return {
                chartData: {
                    columns: ['date', 'loans'],
                    rows: loanData
                }
            }
        }
    })
    new Vue({
        el: '#returnChart',
        data () {
      return {
        chartData: {
          columns: ['date', 'loans', 'returned'],
          rows: returnData
        }
      }
    }
    })
  </script>
</x-app-layout>
